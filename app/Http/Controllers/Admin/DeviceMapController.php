<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\Models\DeviceMap;
use Illuminate\Http\Request;

class DeviceMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data['devicemap'] = DeviceMap::where('MQTT_ID', 'LIKE', "%$keyword%")
                ->orWhere('MODEM_ID', 'LIKE', "%$keyword%")
                ->orWhere('secret_key', 'LIKE', "%$keyword%")
                ->orWhere('max_user_access', 'LIKE', "%$keyword%")
                ->orWhere('IMEI_No', 'LIKE', "%$keyword%")
                ->orWhere('SIM_No', 'LIKE', "%$keyword%")
                ->orWhere('SIM_Plan', 'LIKE', "%$keyword%")
                ->orWhere('subscription_expire_date', 'LIKE', "%$keyword%")
                ->orWhere('subscription_status', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->orWhere('updated_by', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['devicemap'] = DeviceMap::latest()->paginate($perPage);
        }
        $data['title']     = 'Device Map';
        $data['pagetitle'] = 'Device Map';
        // $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        // $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Map',
            'breadcrumb' => [
                'Home'     => 'Device Map',
                'Settings' => 'Device Map',
            ],
        ];
        return view('admin.device-map.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['title']     = 'Device Map';
        $data['pagetitle'] = 'Device Map';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Map',
            'breadcrumb' => [
                'Home'     => 'Device Map',
                'Settings' => 'Device Map',
            ],
        ];
        return view('admin.device-map.create',$data);
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
        $requestData['created_by'] = Auth::guard('admin')->user()->id;
        $requestData['updated_by'] = Auth::guard('admin')->user()->id;
        DeviceMap::create($requestData);

        return redirect('admin/device-map')->with('session_error', 'DeviceMap added!');
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
        $data['devicemap'] = DeviceMap::findOrFail($id);
        $data['title']     = 'Device Map';
        $data['pagetitle'] = 'Device Map';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Map',
            'breadcrumb' => [
                'Home'     => 'Device Map',
                'Settings' => 'Device Map',
            ],
        ];
        return view('admin.device-map.show', $data);
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
        $data['devicemap'] = DeviceMap::findOrFail($id);
        $data['title']     = 'Device Map';
        $data['pagetitle'] = 'Device Map';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Map',
            'breadcrumb' => [
                'Home'     => 'Device Map',
                'Settings' => 'Device Map',
            ],
        ];
        return view('admin.device-map.edit', $data);
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
        $requestData['created_by'] = Auth::guard('admin')->user()->id;
        $requestData['updated_by'] = Auth::guard('admin')->user()->id;
        $devicemap = DeviceMap::findOrFail($id);
        $devicemap->update($requestData);

        return redirect('admin/device-map')->with('session_success', 'subscription_status!');
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
        DeviceMap::destroy($id);

        return redirect('admin/device-map')->with('session_error', 'DeviceMap deleted!');
    }
}
