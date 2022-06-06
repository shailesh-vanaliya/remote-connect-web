<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\DataLog;
use Auth;
use DB;
use App\Models\Report;
use App\Models\Organization;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\ReportConfiguration;
use App\Exports\ReportConfigurationExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ReportController extends Controller
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

        $subQuery =  Report::select(
            'report_configurations.parameter',
            'report_configurations.report_title',
            'devices.modem_id',
            'device_type.device_type',
            'devices.project_name',
            'reports.*',
        );
      
        $subQuery->join('report_configurations',  'report_configurations.id', '=', 'reports.report_config_id');
        $subQuery->join('device_type',  'device_type.id', '=', 'reports.device_type_id');
        $subQuery->join('devices',  'devices.id', '=', 'report_configurations.device_id');
        if (Auth::guard('admin')->user()->role != 'SUPERADMIN') {
            $subQuery->where('report_configurations.created_by', Auth::guard('admin')->user()->id)->latest()->get();
        }
        $data['report'] =  $subQuery->latest('reports.created_at')->get();
        // print_r($data['report'] );
        // exit;
        $data['pagetitle']             = 'Report';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.listInit()'];
        $data['header']    = [
            'title'      => 'Reports',
            'breadcrumb' => [
                'Report'     => '',
                'list' => '',
            ],
        ];
        return view('admin.report.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['pagetitle']             = 'Report';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['header']    = [
            'title'      => 'Reports',
            'breadcrumb' => [
                'Report'     => '',
                'add' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['device'] = Device::select('modem_id', 'id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        } else {
            $data['device'] = Device::select('modem_id', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
            // $data['organization'] = Organization::select('organization_name','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('organization_name', 'id')->toArray();
        }
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->pluck('report_title', 'id')->toArray();
        } else {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('report_title', 'id')->toArray();
        }
        return view('admin.report.create', $data);
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
            $requestData['field_name'] =  json_encode($requestData['fieldList']);
            $requestData['organization_id'] =  1;

            Report::create($requestData);

            return redirect('admin/report')->with('session_success', 'Report added!');
        } catch (\Exception $e) {
            return redirect('admin/report')->with('session_error', $e->getMessage());
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
        $data['report']  = Report::findOrFail($id);
        $data['pagetitle']             = 'Report';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['header']    = [
            'title'      => 'Reports',
            'breadcrumb' => [
                'Report'     => '',
                'show' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['device'] = Device::select('modem_id', 'id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        } else {
            $data['device'] = Device::select('modem_id', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
            // $data['organization'] = Organization::select('organization_name','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('organization_name', 'id')->toArray();
        }
        return view('admin.report.show', $data);
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
        $data['report'] = Report::findOrFail($id);
        $data['pagetitle']             = 'Report';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['header']    = [
            'title'      => 'Reports',
            'breadcrumb' => [
                'Report'     => '',
                'edit' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['device'] = Device::select('modem_id', 'id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        } else {
            $data['device'] = Device::select('modem_id', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
            // $data['organization'] = Organization::select('organization_name','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('organization_name', 'id')->toArray();
        }
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->pluck('report_title', 'id')->toArray();
        } else {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('report_title', 'id')->toArray();
        }
        return view('admin.report.edit', $data);
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
            $requestData['field_name'] =  json_encode($requestData['fieldList']);
            $requestData['organization_id'] =  1;
            $report = Report::findOrFail($id);
            $report->update($requestData);

            return redirect('admin/report')->with('session_success', 'Report updated!');
        } catch (\Exception $e) {
            return redirect('admin/report')->with('session_error', $e->getMessage());
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
        Report::destroy($id);

        return redirect('admin/report')->with('session_success', 'Report deleted!');
    }

    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        switch ($action) {
            case 'getDevicelist':
                $this->_getDevicelist($request->all());
                break;
                break;
        }
        exit;
    }

    public function _getDevicelist($postData)
    {

        // $notificationList = Device::where('device_type_id', $postData['device_type_id'])->orderBy('id','desc')->get()->toArray();

        $subQuery =  Device::select(
            'devices.id',
            'devices.model_no',
            'devices.project_name',
            'devices.modem_id',
        );
        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });
        $subQuery->orWhere('device_map.device_type_id', $postData['device_type_id']);
        $subQuery->groupBy('devices.id');
        $result['deviceList'] =  $subQuery->latest('devices.created_at')->get()->toArray();

        $table = 'datalog';
        $result['column'] =  DB::connection('mysql2')->getSchemaBuilder()->getColumnListing($table);

        echo json_encode($result);
        exit;
    }


    public function reportExport(Request $request){
        // print_r($request->all());
        // exit;
        try {
            return Excel::download(new ReportConfigurationExport($request->all()), 'report-' . date('Ymdhis') . '-.csv');
            // return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            return redirect('admin/report')->with('session_error', 'DataLogExport Exports failed');
        }

    }
}
