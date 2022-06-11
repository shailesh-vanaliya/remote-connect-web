<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use DB;
use App\Models\Report;
use App\Models\Organization;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\ReportConfiguration;
use Illuminate\Http\Request;

class ReportConfigurationController extends Controller
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
       
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['reportconfiguration'] = ReportConfiguration::select('report_configurations.*','devices.modem_id','organizations.organization_name')
            ->Join('devices',  'devices.id', '=', 'report_configurations.device_id')
            ->Join('organizations',  'organizations.id', '=', 'report_configurations.organization_id')
            ->latest('report_configurations.created_at')->get();
        } else {
            $data['reportconfiguration'] = ReportConfiguration::select('report_configurations.*','devices.modem_id','organizations.organization_name')
            ->Join('devices',  'devices.id', '=', 'report_configurations.device_id')
            ->Join('organizations',  'organizations.id', '=', 'report_configurations.organization_id')
            ->where('report_configurations.created_by', Auth::guard('admin')->user()->id)->latest('report_configurations.created_at')->get();
        }


        // $onlineDevice->Join('device_map', function ($join) {
        //     $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
        //     $join->on('device_map.secret_key', '=', 'devices.secret_key');
        // });
        // $onlineDevice->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        // $onlineDevice->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');

        $data['pagetitle']             = 'Report Configuration';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['header']    = [
            'title'      => 'Report Configuration',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'list' => '',
            ],
        ];
        return view('admin.report-configuration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $data['pagetitle']             = 'Report Configuration';
        // $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['ReportConfig.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['js']                    = ['admin/reportConfig.js'];
        $data['pluginjs']               = ['plugins/select2/js/select2.full.min.js'];
      
        $data['header']    = [
            'title'      => 'Report Configuration',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'Create' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $device = Device::select('modem_id', 'id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        } else {
            // echo Auth::guard('admin')->user()->organization_id;
            // exit;
            $subQuery = Device::select('modem_id', 'id',);
            // $subQuery->where('created_by', Auth::guard('admin')->user()->id);
            if (Auth::guard('admin')->user()->role == "ADMIN") {
                    $subQuery->where('organization_id', Auth::guard('admin')->user()->organization_id);
                } else {
                    $subQuery->where('created_by', Auth::guard('admin')->user()->id);
                }
            $device = $subQuery->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
            // $data['organization'] = Organization::select('organization_name','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('organization_name', 'id')->toArray();
            
            // $subQuery =  Device::select('modem_id', 'id');
            // $subQuery->where('created_by', Auth::guard('admin')->user()->id);
            // // if (Auth::guard('admin')->user()->role == "ADMIN") {
            // //     $subQuery->where('created_by', Auth::guard('admin')->user()->organization_id);
            // // } else {
            // //     $subQuery->where('created_by', Auth::guard('admin')->user()->id);
            // // }
            // $subQuery->pluck('modem_id', 'id');
            // $device = $subQuery->get()->toArray();

        }
      
        $data['column'] = array();
        // $data['column'] =  DB::connection('mysql2')->getSchemaBuilder()->getColumnListing($table);
        // $data['column'] = $this->_getDevicelist($data['reportconfiguration']);
        $deviceSelect[''] = '--Select Device---';
        $data['device'] =  $returnCollegeData = $deviceSelect + $device;

        return view('admin.report-configuration.create', $data);
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

        try {
            $requestData = $request->all();
            // print_r($requestData);
            // exit;
            $deviceObj = new Device();
            $deviceRes =  $deviceObj->deviceDetailById($requestData['device_id']);
       
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $requestData['parameter'] = json_encode($requestData['parameter']);
            if (Auth::guard('admin')->user()->role != "SUPERADMIN") {
                $requestData['organization_id'] = Auth::guard('admin')->user()->organization_id;
            }
            $res = ReportConfiguration::create($requestData);
          
            $requestData['report_config_id'] = $res->id;
            $requestData['device_type_id'] = $deviceRes->device_type_id;
            // print_r($requestData);
            // exit;
            Report::create($requestData);

            return redirect('admin/report-configuration')->with('session_success', 'ReportConfiguration added!');
        } catch (\Exception $e) {
            return redirect('admin/report-configuration')->with('session_error', $e->getMessage());
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
        $data['reportconfiguration'] = ReportConfiguration::findOrFail($id);
        $data['pagetitle']             = 'Report Configuration';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['header']    = [
            'title'      => 'Reports',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'Show' => '',
            ],
        ];
        return view('admin.report-configuration.show', $data);
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
        $data['reportconfiguration'] = ReportConfiguration::findOrFail($id);
        $data['pagetitle']             = 'Report Configuration';
        $data['funinit']               = ['ReportConfig.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['js']                    = ['admin/reportConfig.js'];
        $data['pluginjs']               = ['plugins/select2/js/select2.full.min.js'];
      

        $data['header']    = [
            'title'      => 'Report Configuration',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'edit' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['device'] = Device::select('modem_id', 'id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        } else {
            // $data['device'] = Device::select('modem_id', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $subQuery = Device::select('modem_id', 'id',);
            // $subQuery->where('created_by', Auth::guard('admin')->user()->id);
            if (Auth::guard('admin')->user()->role == "ADMIN") {
                    $subQuery->where('organization_id', Auth::guard('admin')->user()->organization_id);
                } else {
                    $subQuery->where('created_by', Auth::guard('admin')->user()->id);
                }
            $data['device'] = $subQuery->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        }

        $column = $this->_getDevicelist($data['reportconfiguration']);
        $data['column'] = $column['column'];
        return view('admin.report-configuration.edit', $data);
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
        try {
            $requestData = $request->all();
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $reportconfiguration = ReportConfiguration::findOrFail($id);
            $requestData['parameter'] = json_encode($requestData['parameter']);
            if (Auth::guard('admin')->user()->role != "SUPERADMIN") {
                $requestData['organization_id'] = Auth::guard('admin')->user()->organization_id;
            }
            $id = $reportconfiguration->update($requestData);

            return redirect('admin/report-configuration')->with('session_success', 'ReportConfiguration updated!');
        } catch (\Exception $e) {
            return redirect('admin/report-configuration')->with('session_error', $e->getMessage());
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
        ReportConfiguration::destroy($id);

        return redirect('admin/report-configuration')->with('session_success', 'ReportConfiguration deleted!');
    }

    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        switch ($action) {
            case 'getDevicelist':
                $result = $this->_getDevicelist($request->all());
                echo json_encode($result);
                exit;
                break;
        }
        exit;
    }

    public function _getDevicelist($postData)
    {

        $subQuery =  Device::select(
            'devices.id',
            'devices.model_no',
            'devices.project_name',
            'devices.modem_id',
            'device_type.device_type',
            'device_type.data_source',
            'device_type.data_table',
        );
        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });
        $subQuery->Join('device_type',  'device_type.id', '=', 'device_map.device_type_id');
        $subQuery->Where('devices.id', $postData['device_id']);
        $subQuery->groupBy('devices.id');
        $deviceList=  $subQuery->latest('devices.created_at')->first()->toArray();
        $result['column'] =  DB::connection('mysql2')->getSchemaBuilder()->getColumnListing($deviceList['data_table']);
        return $result;
    }


}
