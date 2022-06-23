<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Models\Device;
use App\Models\DeviceMap;
use App\Models\Organization;
use App\Models\User;
use App\Models\DeviceAliasmap;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
use Helper;
use PhpMqtt\Client\Facades\MQTT;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $perPage = 100;
        $collected_items = Device::whereNotNull('latitude')->whereNotNull('longitude')
            ->get()->toArray();
        $mainArray = [];
        foreach ($collected_items as $key => $values) {
            // print_r($values['location']);
            // exit;
            $tempArray = array($values['location'], $values['latitude'], $values['longitude'], $values['id']);
            $mainArray[$key] = $tempArray;
        }

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {

            $subQuery =  Device::select(
                'device_map.MQTT_ID',
                // 'device_map.MODEM_ID',
                'device_map.max_user_access',
                'device_map.IMEI_No',
                'device_status.Status',
                'remote.MACHINE_NO',
                'remote.MACHINE_LOCAL_IP',
                'remote.MACHINE_LOCAL_PORT',
                'remote.MACHINE_REMOTE_PORT',
                'device_map.subscription_status',
                'device_type.device_type',
                'device_type.data_table',
                'device_type.dashboard_id',
                'devices.*',
            );
            // $subQuery->where('device.modem_id', 'LIKE', "%$keyword%");
            $subQuery->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $subQuery->orWhere('devices.location', 'LIKE', "%$keyword%");
            $subQuery->orWhere('devices.updated_by', 'LIKE', "%$keyword%");
            $subQuery->groupBy('devices.id');
            $data['device'] =  $subQuery->latest('devices.created_at')->paginate($perPage);

            $location = Device::select(
                'location',
                'location',
            )->pluck('location', 'location')->toArray();
        } else {

            $subQuery =  Device::select(

                'device_map.MQTT_ID',
                // 'device_map.MODEM_ID',
                'device_map.max_user_access',
                'device_map.subscription_status',
                'device_map.IMEI_No',
                'device_status.Status',
                'device_type.device_type',
                'device_type.data_table',
                'device_type.dashboard_id',
                'devices.*',
            );
            if ($keyword) {
                $subQuery->orWhere('devices.location', 'LIKE', "%$keyword%");
            }
            // print_r(Auth::guard('admin')->user());
            // exit;
            if (Auth::guard('admin')->user()->role == "ADMIN") {
                $subQuery->where('devices.organization_id', Auth::guard('admin')->user()->organization_id);
            } else {
                $subQuery->where('devices.created_by', Auth::guard('admin')->user()->id);
            }
            $subQuery->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $subQuery->groupBy('devices.id');
            $data['device'] =  $subQuery->latest('devices.created_at')->paginate($perPage);

            $location = Device::select(
                'location',
                'location',
            )->where('created_by', Auth::guard('admin')->user()->id)->pluck('location', 'location')->toArray();
        }
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        $agentRecord[''] = '- - Select Location - -';
        $data['js']                    = ['admin/device.js'];
        $data['funinit']               = ['Device.initList()'];
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
            // $data['device'] = Device::where('modem_id', 'LIKE', "%$keyword%")
            //     ->where('id', '!=', $id)
            // ->latest()->get();
            $subQuery =  Device::select(
                'device_map.MQTT_ID',
                'device_map.max_user_access',
                'device_map.IMEI_No',
                'device_status.Status',
                'devices.*',
            );
            $subQuery->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $subQuery->where('devices.id', '!=', $id);
            $subQuery->groupBy('devices.id');
            $data['device'] =  $subQuery->get();
        } else {
            // if ($keyword) {
            //     $data['device'] = Device::where('created_by', Auth::guard('admin')->user()->id)
            //         ->where('id', '!=', $id)
            //         ->Where('location', 'LIKE', "%$keyword%")
            //         ->latest()->get();
            // } else {
            //     $data['device'] = Device::where('created_by', Auth::guard('admin')->user()->id)
            //         ->where('id', '!=', $id)
            //         ->latest()->get();
            // }
            $subQuery =  Device::select(
                'devices.modem_id as modem_id',
                'devices.secret_key as  secret_key',
                'devices.id',
                'devices.location',
                'device_map.MQTT_ID',
                'device_map.MODEM_ID',
                'device_map.max_user_access',
                'device_map.IMEI_No',
                'device_status.Status',
                'devices.*',
            );
            if ($keyword) {
                $subQuery->Where('devices.location', 'LIKE', "%$keyword%");
            }
            $subQuery->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $subQuery->where('devices.created_by', Auth::guard('admin')->user()->id);
            $subQuery->where('devices.id', '!=', $id);
            $data['device'] =  $subQuery->get();
        }

        $data['deviceDetail'] = Device::findOrFail($id);
        $subQuery =  Device::select(
            'device_map.MQTT_ID',
            'device_map.max_user_access',
            'device_map.IMEI_No',
            'device_status.Status',
            'device_status.id as device_status_id',
            'remote.MACHINE_NO',
            'remote.MACHINE_LOCAL_IP',
            'remote.MACHINE_LOCAL_PORT',
            'remote.MACHINE_REMOTE_PORT',
            'remote.STATUS',
            'devices.*',
        );

        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });

        $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
        $subQuery->where('devices.id', '=', $id);
        $subQuery->groupBy('devices.id');
        $data['deviceDetail'] =  $subQuery->first();
        // print_r($data['deviceDetail']);
        // exit;
        if (empty($data['deviceDetail'])) {
            return redirect('admin/device')->with('session_error', 'Sorry, Device details not found!');
        }


        $data['remote'] = array();
        $data['remote'] = DB::table('remote')->where('MQTT_ID', $data['deviceDetail']->MQTT_ID)->orderBy('MACHINE_NO', 'asc')->get()->toArray();

        $map = "";
        $status = 0;
        if (isset($data['deviceDetail']) && $data['deviceDetail']->secret_key) {
            $map = DeviceMap::where('secret_key', $data['deviceDetail']->secret_key)
                ->where('modem_id', $data['deviceDetail']->modem_id)->first();
            if ($map) {
                $statusRes =  DB::table('device_status')->where('Client_id', $map->MQTT_ID)->first();
                $status = ($statusRes) ? $statusRes->Status : 0;
            }
        }

        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        $data['status'] = $status;

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

        $data['js']        = ['admin/device.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['Device.init()'];
        $data['header']    = [
            'title'      => 'Device',
            'breadcrumb' => [
                'Device'     => '',
                'Create' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        } else {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        }
        $userObj = new User();
        $data['createdBy'] = $userObj->getAssignToUser();

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
            // "modem_id" => "required|unique:devices",
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

            $modemMapCount = DeviceMap::where('MODEM_ID', $request->all('modem_id'))->first();
            $modemCount = Device::where('modem_id', $request->all('modem_id'))->count();
            if (isset($modemMapCount) &&  $modemCount >= $modemMapCount->max_user_access) {
                return redirect('admin/device/create')->with('session_error', 'Sorry, maximum user device limit exceed, contact to admin!')->withInput();
            }

            // $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            if (Auth::guard('admin')->user()->role == "USER") {
                $requestData['organization_id'] = Auth::guard('admin')->user()->organization_id;
            }

            $res =  Device::create($requestData);

            $objDevice = new Device();
            $alias = $objDevice->deviceDetail($res->id);


            $collegeDetails = DeviceAliasmap::firstOrNew(array('modem_id' => $alias['modem_id']));
            $collegeDetails->dashboard_alias = $alias->dashboard_alias;
            $collegeDetails->parameter_alias = $alias->parameter_alias;
            $collegeDetails->chart_alias = $alias->chart_alias;
            $collegeDetails->updated_at = Carbon::now();
            $collegeDetails->created_at = Carbon::now();
            $collegeDetails->updated_by = Auth::guard('admin')->user()->id;
            $collegeDetails->created_by = Auth::guard('admin')->user()->id;
            $collegeDetails->save();
             


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
        $data['js']        = ['admin/device.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['Device.init()'];
        $data['header']    = [
            'title'      => 'Device Edit',
            'breadcrumb' => [
                'Device'     => '',
                'Edit' => '',
            ],
        ];

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        } else {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        }
        $userObj = new User();
        $data['createdBy'] = $userObj->getAssignToUser();
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

            $modemMapCount = DeviceMap::where('MODEM_ID', $request->all('modem_id'))->first();

            $modemCount = Device::where('id', '!=', $id)->where('modem_id', $request->all('modem_id'))->count();
            if (isset($modemMapCount) &&  $modemCount >= $modemMapCount->max_user_access) {
                return redirect("admin/device/$id/edit")->with('session_error', 'Sorry, maximum user device limit exceed, contact to admin!')->withInput();
            }
            try {
                $requestData['updated_by'] = Auth::guard('admin')->user()->id;
                if (Auth::guard('admin')->user()->role == "USER") {
                    $requestData['organization_id'] = Auth::guard('admin')->user()->organization_id;
                }
                $device = Device::findOrFail($id);
                $device->update($requestData);

                return redirect('admin/device')->with('session_success', 'Device updated!');
            } catch (\Exception $e) {
                return redirect(`admin/device/$id/edit`)->with('session_error', $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect(`admin/device/$id/edit`)->with('session_error', $e->getMessage());
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

        return redirect('admin/device')->with('session_success', 'Device deleted!');
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
                'ip' => (isset($requestData['secure']) && $requestData['secure'] == 'on' ? $request->ip() : ""),
                'timestamp' => date('Y-m-d H:i:s.u'),
                'user' => Auth::guard('admin')->user()->email,
                'Modem id' => $requestData['modem_id'],
            );
            $res = MQTT::publish('REMOTE/ENABLE/' . $requestData['MQTT_ID'], json_encode($data));

            // DB::table('device_status')->where('id', $requestData['statusId'])
            // ->update(['Status' => $requestData['connect'] == 'connect' ? 1 : 0]);

            if ($requestData['connect'] ==  'connect') {
                return redirect("admin/device/device-detail/$id")->with('session_success', 'Device connected successfully!')->withInput();
            } else if ($requestData['connect'] ==  'disconnect') {
                return redirect("admin/device/device-detail/$id")->with('session_error', 'Device disconnected successfully!')->withInput();
            } else {
                return redirect("admin/device/device-detail/$id")->with('session_error', 'Some think will be wrong!')->withInput();
            }
        } catch (\Exception $e) {
            return redirect(`admin/device`)->with('session_error', $e->getMessage());
        }
    }

    public function updateName(Request $request)
    {
        try {
            //  print_r($request->all());
            //  exit;
            $requestData = $request->all();
            DB::table('remote')->where('id', $requestData['deviceid'])
                ->update(['device_name' => $requestData['device_name']]);
            $id = $requestData['deviceIds'];
            // $request->session()->flash('session_success', 'Device name updated Successfully');
            // return Redirect::to($_SERVER['HTTP_REFERER']);
            return redirect("admin/device/device-detail/$id")->with('session_success', 'Device name updated Successfully')->withInput();
        } catch (\Exception $e) {
            $request->session()->flash('session_error', $e->getMessage());
        }
    }

    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        switch ($action) {
            case 'getLocation':
                $this->_getLocationList();
                break;
            case 'getDevicelist':
                $this->_getDevicelist($request->all());
                break;
        }
        exit;
    }


    public function _getDevicelist($postData)
    {
        $query = DeviceMap::where('secret_key', $postData['secret_key']);
        $query->where('modem_id', $postData['modem_id']);
        if (Auth::guard('admin')->user()->role != 'SUPERADMIN') {
            $query->where('organization_id', Auth::guard('admin')->user()->organization_id);
        }
        $deviceMapDetails = $query->first();
        echo json_encode($deviceMapDetails);
        exit;
    }

    public function _getLocationList()
    {

        // $subQuery =  Device::whereNotNull('latitude')->whereNotNull('longitude');
        // if (Auth::guard('admin')->user()->role != 'SUPERADMIN') {
        //     $subQuery->where('created_by', Auth::guard('admin')->user()->id);
        // }
        // $collected_items = $subQuery->get()->toArray();
        $deviceObj = new Device();
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN' || Auth::guard('admin')->user()->role == 'USER') {
            $collected_items = $deviceObj->getDeviceByUser()->toArray();
        } else {
            $collected_items = $deviceObj->getDeviceByOrganization()->toArray();
        }


        $locationList = [];
        foreach ($collected_items as $key => $values) {

            $url = url('/admin/' . $values['dashboard_id'] . '/' . $values['modem_id']);
            $url = ($values['dashboard_id'] == '') ? "#" : $url;
            // $url = url('/admin/meter-dashboard/' .$values['modem_id'] );
            $tempArray = array("Modem Id : " . $values['modem_id'] . " <br /> Project Name : " .  $values['project_name'] . " <br /> Region : " .  $values['region'] . " <br /> Location : " . $values['location'] . " <br />  <a href='" . $url . "'>" . 'View Dashboard' . '</a>', $values['latitude'], $values['longitude'], $values['id']);
            $locationList[$key] = $tempArray;
        }
        echo json_encode($locationList);
        exit;
    }

    /**
     * Display a deviceDetail of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function mapAlias($id, Request $request)
    {

        if ($request->isMethod('post')) {
            $postData = $request->all();
            $parameter_alias = [];
            $dashboard_alias = [];
            $chart_alias = [];
            foreach ($postData['dashboard_alias']  as $key => $val) {
                $dashboard_alias[$key] = $val;
            }
            foreach ($postData['parameter_alias']  as $key => $val) {
                $parameter_alias[$key] = $val;
            }
            foreach ($postData['chart_alias']  as $key => $val) {
                $chart_alias[$key] = $val;
            }
         
            DeviceAliasmap::where(['modem_id' => $id])
                ->update([
                    'parameter_alias' => json_encode($parameter_alias),
                    'dashboard_alias' => json_encode($dashboard_alias),
                    'chart_alias' => json_encode($chart_alias),
                    'updated_at' => Carbon::now(),
                ]);
            return redirect('admin/device')->with('session_success', 'Device Alias updated successfully!');
        }


        $subQuery =  Device::select(
            'device_map.MQTT_ID',
            'device_map.max_user_access',
            'device_map.IMEI_No',
            'device_status.Status',
            'device_status.id as device_status_id',
            'remote.MACHINE_NO',
            'remote.MACHINE_LOCAL_IP',
            'remote.MACHINE_LOCAL_PORT',
            'remote.MACHINE_REMOTE_PORT',
            'remote.STATUS',
            'devices.*',
        );

        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });

        $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
        $subQuery->where('devices.id', '=', $id);
        $subQuery->groupBy('devices.id');
        $data['deviceDetail'] =  $subQuery->first();

        // if (empty($data['deviceDetail'])) {
        //     return redirect('admin/device')->with('session_error', 'Sorry, Device details not found!');
        // }
        $jsonDecode =  DeviceAliasmap::where('modem_id', $data['deviceDetail']['modem_id'])->first();
        if(empty($jsonDecode )){
            
            DeviceAliasmap::where(['modem_id' => $data['deviceDetail']['modem_id']])
            ->insert([
                'dashboard_alias' => '{"CONTROLLER1_TITLE": "MASTER", "CONTROLLER2_TITLE": "ZONE1", "CONTROLLER3_TITLE": "ZONE2", "CONTROLLER4_TITLE": "ZONE3", "CONTROLLER5_TITLE": "ZONE4","CONTROLLER6_TITLE": "ZONE5","CONTROLLER7_TITLE": "ZONE6","CONTROLLER8_TITLE": "ZONE7","CONTROLLER9_TITLE": "ZONE8"}',
                'parameter_alias' => '{"dtm":"Time","pv1":"master pv","sp1":"master sp","out1":"mastre output","obit1":"master status", "pv2":"zone1 pv", "sp2":"zone1 sp","out2":"zone1 output","obit2":"zone1 status","pv3":"zone2 pv", "sp3":"zone2 sp","out3":"zone2 output","obit3":"zone2 status","pv4":"zone3 pv", "sp4":"zone3 sp","out4":"zone3 output","obit4":"zone3 status","pv5":"zone4 pv", "sp5":"zone4 sp","out5":"zone4 output","obit5":"zone4 status","pv6":"zone5 pv", "sp6":"zone5 sp","out6":"zone5 output","obit6":"zone5 status","pv1_unit":"°C","sp1_unit":"°C","out1_unit":"%","obit1_unit":" ","pv2_unit":"°C","sp2_unit":"°C","out2_unit":"%","obit2_unit":" ","pv3_unit":"°C","sp3_unit":"°C","out3_unit":"%","obit3_unit":" ","pv4_unit":"°C","sp4_unit":"°C","out4_unit":"%","obit4_unit":" ","pv5_unit":"°C","sp5_unit":"°C","out5_unit":"%","obit5_unit":" ","pv6_unit":"°C","sp6_unit":"°C","out6_unit":"%","obit6_unit":" "}',
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'modem_id' => $data['deviceDetail']['modem_id'],
                'updated_by' => Auth::guard('admin')->user()->id,
                'created_by' => Auth::guard('admin')->user()->id,
            ]);
            $jsonDecode =  DeviceAliasmap::where('modem_id', $data['deviceDetail']['modem_id'])->first();
        }
       
//         Helper::getAliasData($id);
// echo " fdsfsd";
// exit;
        $data['dashboard_alias'] = (isset($jsonDecode['dashboard_alias']) && !empty($jsonDecode['dashboard_alias'])) ? json_decode($jsonDecode['dashboard_alias'], TRUE) : "";
        $data['parameter_alias'] = (isset($jsonDecode['parameter_alias']) && !empty($jsonDecode['parameter_alias'])) ? json_decode($jsonDecode['parameter_alias'], TRUE) : "";
        $data['chart_alias'] = (isset($jsonDecode['chart_alias']) && !empty($jsonDecode['chart_alias'])) ? json_decode($jsonDecode['chart_alias'], TRUE) : "";
       
       
        $data['pagetitle'] = 'Device';
        $data['title'] = 'Device';
        $data['js']        = ['admin/device.js', 'jquery.validate.min.js'];
        // $data['funinit']   = ['Device.init()'];
        $data['header']    = [
            'title'      => 'Device Alias',
            'breadcrumb' => [
                'Device'     => '',
                'Alias' => '',
            ],
        ];
        return view('admin.device.map', $data);
    }
}
