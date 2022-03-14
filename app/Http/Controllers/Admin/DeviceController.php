<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Models\Device;
use App\Models\DeviceMap;
use Illuminate\Http\Request;
use Auth;
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

        if (!empty($keyword)) {
            $data['device'] = Device::where('modem_id', 'LIKE', "%$keyword%")
                ->orWhere('secret_key', 'LIKE', "%$keyword%")
                ->orWhere('project_name', 'LIKE', "%$keyword%")
                ->orWhere('customer_name', 'LIKE', "%$keyword%")
                ->orWhere('region', 'LIKE', "%$keyword%")
                ->orWhere('location', 'LIKE', "%$keyword%")
                ->orWhere('machine_type', 'LIKE', "%$keyword%")
                ->orWhere('latitude', 'LIKE', "%$keyword%")
                ->orWhere('longitude', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->orWhere('updated_by', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['device'] = Device::latest()->paginate($perPage);
        }
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        return view('admin.device.index', $data);
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
            $count = DeviceMap::where('MODEM_ID', $request->all('modem_id'))
            ->where('secret_key', $request->all('secret_key'))->count();
            if($count == 0){
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
}
