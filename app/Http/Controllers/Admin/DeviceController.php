<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Models\Device;
use App\Models\DeviceMap;
use Illuminate\Http\Request;
use Auth;
use DB;
use PhpMqtt\Client\Facades\MQTT;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 100;

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['device'] = Device::where('modem_id', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->orWhere('updated_by', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
                $location = Device::select(
                    'location',
                    'location',
                )->pluck('location', 'location')->toArray();
        } else {
            if ($keyword) {
                $data['device'] = Device::where('created_by', Auth::guard('admin')->user()->id)
                    ->Where('location', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $data['device'] = Device::where('created_by', Auth::guard('admin')->user()->id)
                    ->latest()->paginate($perPage);
            }
            $location = Device::select(
                'location',
                'location',
            )->where('created_by', Auth::guard('admin')->user()->id)->pluck('location', 'location')->toArray();
        }
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        
        $agentRecord[''] = '- - Select Location - -';
        // print_r($location);
        // exit;
        $data['location'] = $agentRecord + $location;

        return view('admin.device.index', $data);
    }
    /**
     * Display a deviceDetail of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function deviceDetail($id)
    {
        $keyword = "";

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['device'] = Device::where('modem_id', 'LIKE', "%$keyword%")
                ->where('id', '!=', $id)
                // ->orWhere('location', 'LIKE', "%$keyword%")
                // ->orWhere('updated_by', 'LIKE', "%$keyword%")
                ->latest()->get();
        } else {
            if ($keyword) {
                $data['device'] = Device::where('created_by', Auth::guard('admin')->user()->id)
                     ->where('id', '!=', $id)
                    ->Where('location', 'LIKE', "%$keyword%")
                    ->latest()->get();
            } else {
                $data['device'] = Device::where('created_by', Auth::guard('admin')->user()->id)
                ->where('id', '!=', $id)
                    ->latest()->get();
            }
        }
       
        $data['deviceDetail'] = Device::findOrFail($id);
        $map = "";
        $status = 0;
         if( isset($data['deviceDetail']) && $data['deviceDetail']->secret_key){
           $map = DeviceMap::where('secret_key' , $data['deviceDetail']->secret_key)
            ->where('modem_id' , $data['deviceDetail']->modem_id)->first();
            if($map){
                $statusRes =  DB::table('device_status')->where('Client_id', $map->MQTT_ID)->first();
                $status = ($statusRes ) ? $statusRes->Status : 0;
            }
         }

        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        $data['status'] = $status;
        //  print_r($data['deviceDetail']);
        //  exit;
        return view('admin.device.details', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        return view('admin.device.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        $rules = [
            "modem_id" => "required",
            "secret_key" => "required",
            "project_name" => "required",
            "location" => "required",
        ];
        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/device/create")->withErrors($validator)->withInput();
            }
            $mapCount = DeviceMap::where('MODEM_ID', $request->all('modem_id'))
                ->where('secret_key', $request->all('secret_key'))->count();
            if ($mapCount == 0) {
                return redirect('admin/device/create')->with('session_error', 'Sorry, Model Id or Secret key not available!')->withInput();
            }
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            Device::create($requestData);

            return redirect('admin/device')->with('session_success', 'Device added!');
        } catch (\Exception $e) {
            return redirect('admin/device/create')->with('session_error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['device'] = Device::findOrFail($id);
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        return view('admin.device.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['device'] = Device::findOrFail($id);
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        return view('admin.device.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $rules = [
            "modem_id" => "required",
            "secret_key" => "required",
            "project_name" => "required",
            "location" => "required",
        ];
        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/device/$id/edit")->withErrors($validator)->withInput();
            }
            $mapCount = DeviceMap::where('MODEM_ID', $request->all('modem_id'))
                ->where('secret_key', $request->all('secret_key'))->count();
            if ($mapCount == 0) {
                return redirect(`admin/device/$id/edit`)->with('session_error', 'Sorry, Model Id or Secret key not available!')->withInput();
            }
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $device = Device::findOrFail($id);
            $device->update($requestData);

            return redirect('admin/device')->with('session_success', 'Device updated!');
        } catch (\Exception $e) {
            return redirect('admin/device/create')->with('session_error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Device::destroy($id);

        return redirect('admin/device')->with('flash_message', 'Device deleted!');
    }

    public function uploadFile(Request $request)
    {

        $requestData = $request->all();

        try {
            $rules = [
                "logo" => "required",
            ];
            $id = $requestData['deviceId'];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/device/device-detail/$id")->with('session_error', 'Please select files!')->withInput();
                // return redirect("admin/device/device-detail/$id")->withErrors($validator)->withInput();
            }
            if ($request->hasFile('logo')) {
                // $old_photo = $requestData['old_photo'];
                // unlink(asset('/public/uploads/device/' . $requestData['old_photo']));
                $files2 = $request->file('logo');
                $logo = time() . $files2->getClientOriginalName();
                $files2->move(public_path() . '/uploads/device/', $logo);
                $device = Device::findOrFail($requestData['deviceId']);
                $device['img'] = $logo;
                $device->save();
            }
            return redirect("admin/device/device-detail/$id")->with('session_success', 'Image updated successfully!')->withInput();
        } catch (\Exception $e) {
            return redirect(`admin/device`)->with('session_error', $e->getMessage());
        }
    }
    
    public function connectServer(Request $request)
    {

        $requestData = $request->all();
        // print_r($requestData);exit;
        $id = $requestData['deviceId'];
        try {
            $data = array(
                'data' => ($requestData['connect'] == 'connect' ? 1 : 0),
                'secure' => (isset($requestData['secure']) && $requestData['secure'] == 'on' ? 1 : 0),
                'timestamp' => date('Y-m-d H:i:s.u'),
                'user' => Auth::guard('admin')->user()->email,
                'Modem id' => $requestData['modem_id'],
            );

            MQTT::publish('shailesh/1', json_encode($data));

            // {"data":1,"user":*Login Email id,"timestamp":"2022-03-05 11:29:38.865053",
            // "Modem id":"*MODEM_ID"}

            if ($requestData['connect'] ==  'connect') {
                return redirect("admin/device/device-detail/$id")->with('session_success', 'Device connected successfully!')->withInput();
            } else if ($requestData['connect'] ==  'disconnect') {
                return redirect("admin/device/device-detail/$id")->with('session_success', 'Device disconnect successfully!')->withInput();
            } else {
                return redirect("admin/device/device-detail/$id")->with('session_error', 'Some think will be wrong!')->withInput();
            }
        } catch (\Exception $e) {
            return redirect(`admin/device`)->with('session_error', $e->getMessage());
        }
    }
}
