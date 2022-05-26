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

        if (!empty($keyword)) {
            $data['report']  = Report::where('device_id', 'LIKE', "%$keyword%")
                ->orWhere('device_type_id', 'LIKE', "%$keyword%")
                ->orWhere('field_name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['report']  = Report::latest()->paginate($perPage);
        }
        $data['pagetitle']             = 'Report';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = [''];
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
            $data['device'] = Device::select('modem_id','id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name','id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type','id',)->pluck('device_type', 'id')->toArray();
        }else{
            $data['device'] = Device::select('modem_id','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name','id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type','id',)->pluck('device_type', 'id')->toArray();
            // $data['organization'] = Organization::select('organization_name','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('organization_name', 'id')->toArray();
        }
 
        return view('admin.report.create',$data);
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
        $requestData['field_name'] =  json_encode($requestData['fieldList']);
        $requestData['organization_id'] =  1;

        Report::create($requestData);

        return redirect('admin/report')->with('session_success', 'Report added!');
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
            $data['device'] = Device::select('modem_id','id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name','id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type','id',)->pluck('device_type', 'id')->toArray();
        }else{
            $data['device'] = Device::select('modem_id','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name','id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type','id',)->pluck('device_type', 'id')->toArray();
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
            $data['device'] = Device::select('modem_id','id',)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name','id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type','id',)->pluck('device_type', 'id')->toArray();
        }else{
            $data['device'] = Device::select('modem_id','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name','id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type','id',)->pluck('device_type', 'id')->toArray();
            // $data['organization'] = Organization::select('organization_name','id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('organization_name', 'id')->toArray();
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
        
        $requestData = $request->all();
        $requestData['field_name'] =  json_encode($requestData['fieldList']);
        $requestData['organization_id'] =  1;
        $report = Report::findOrFail($id);
        $report->update($requestData);

        return redirect('admin/report')->with('session_success', 'Report updated!');
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

    public function _getDevicelist($postData) {
        
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

}
