<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use DB;
use App\Models\ReportSchedule;
use App\Models\User;
use App\Models\ReportConfiguration;
use Illuminate\Http\Request;

class ReportSchedulesController extends Controller
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

        // if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
        //     $data['reportschedules'] = ReportSchedule::latest()->get();
        // } else {
        //     $data['reportschedules'] = ReportSchedule::where('created_by', Auth::guard('admin')->user()->id)->latest()->get();
        // }
        $subQuery =  ReportSchedule::select(
            'report_configurations.parameter',
            'report_configurations.report_title',
            'devices.modem_id',
            'device_type.device_type',
            'device_type.data_table',
            'devices.project_name',
            'report_schedules.*',
        );
      
        $subQuery->leftJoin('report_configurations',  'report_configurations.id', '=', 'report_schedules.report_config_id');
        $subQuery->leftJoin('reports',  'reports.report_config_id', '=', 'report_configurations.id');
        $subQuery->leftJoin('device_type',  'device_type.id', '=', 'reports.device_type_id');
        $subQuery->join('devices',  'devices.id', '=', 'report_configurations.device_id');
        if (Auth::guard('admin')->user()->role != 'SUPERADMIN') {
            if (Auth::guard('admin')->user()->role == "ADMIN") {
                $subQuery->where('report_configurations.organization_id', Auth::guard('admin')->user()->organization_id);
            } else {
                $subQuery->where('report_configurations.created_by', Auth::guard('admin')->user()->id);
            }
        }
        $data['reportschedules'] =  $subQuery->latest('report_schedules.created_at')->get();
        // Auth::guard('admin')->user()->organization_id

        $data['pagetitle']             = 'Report schedules';
        $data['js']                    = ['admin/reportSchedul.js'];
        $data['funinit']               = ['ReportSchedul.listInit()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];

        $data['header']    = [
            'title'      => 'Report schedules',
            'breadcrumb' => [
                'Report schedules'     => '',
                'edit' => '',
            ],
        ];

        return view('admin.report-schedules.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['pagetitle']             = 'Report schedules';
        $data['js']                    = ['admin/reportSchedul.js'];
        $data['funinit']               = ['ReportSchedul.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['pluginjs']               = ['plugins/select2/js/select2.full.min.js'];
        $data['header']    = [
            'title'      => 'Report schedules',
            'breadcrumb' => [
                'Report schedules'     => '',
                'edit' => '',
            ],
        ];
        $data['days'] = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['userList'] = User::select('first_name', 'id',)->where('role', 'USER')->pluck('first_name', 'id')->toArray();
        } else {
            $data['userList'] = User::select('first_name', 'id',)->where('role', 'USER')->where('organization_id', Auth::guard('admin')->user()->organization_id)->pluck('first_name', 'id')->toArray();
        }

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->pluck('report_title', 'id')->toArray();
        } else {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('report_title', 'id')->toArray();
        }
        $userObj = new User();
        $data['createdBy'] = $userObj->getAssignToUser();
        $data['userList'] = $userObj->getAssignToUser();
        return view('admin.report-schedules.create', $data);
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

            $modemMapCount = User::where('id', Auth::guard('admin')->user()->id)->first();
            $modemCount = ReportSchedule::where('created_by',Auth::guard('admin')->user()->id)->count();
            if (isset($modemMapCount) &&  $modemCount >= $modemMapCount->report_quota) {
                return redirect('admin/report-configuration/create')->with('session_error', 'Sorry, maximum report quota limit exceed, contact to admin!')->withInput();
            }

        
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $requestData['is_updated'] = 1;
            $requestData['repeat_on'] = json_encode($requestData['repeat_on']);
            $requestData['sender_user_list'] = isset($requestData['sender_user_list']) ? json_encode($requestData['sender_user_list']) : '';

            ReportSchedule::create($requestData);

            return redirect('admin/report-schedules')->with('session_success', 'ReportSchedule added!');
        } catch (\Exception $e) {
            return redirect('admin/report-schedules/create')->with('session_error', $e->getMessage());
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
        $data['reportschedule'] = ReportSchedule::findOrFail($id);
        $data['pagetitle']             = 'Report schedules';
        $data['js']                    = ['admin/reportSchedul.js'];
        $data['funinit']               = ['ReportSchedul.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['header']    = [
            'title'      => 'Report schedules',
            'breadcrumb' => [
                'Report schedules'     => '',
                'edit' => '',
            ],
        ];
        return view('admin.report-schedules.show', $data);
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
        $data['reportschedule'] = ReportSchedule::findOrFail($id);
        $data['pagetitle']             = 'Report schedules';
        $data['js']                    = ['admin/reportSchedul.js'];
        $data['funinit']               = ['ReportSchedul.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['pluginjs']               = ['plugins/select2/js/select2.full.min.js'];
        $data['header']    = [
            'title'      => 'Report schedules',
            'breadcrumb' => [
                'Report schedules'     => '',
                'edit' => '',
            ],
        ];
        $data['days'] = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        // if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
        //     $data['userList'] = User::select('first_name', 'id',)->where('role', 'USER')->pluck('first_name', 'id')->toArray();
        // } else {
        //     $data['userList'] = User::select('first_name', 'id',)->where('role', 'USER')->where('organization_id', Auth::guard('admin')->user()->organization_id)->pluck('modem_id', 'id')->toArray();
        // }
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->pluck('report_title', 'id')->toArray();
        } else {
            $data['reportConfiguration'] = ReportConfiguration::select('report_title', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('report_title', 'id')->toArray();
        }
        $userObj = new User();
        $data['userList'] = $userObj->getAssignToUser();
        $data['createdBy'] = $userObj->getAssignToUser();
        return view('admin.report-schedules.edit', $data);
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
            $requestData['repeat_on'] = json_encode($requestData['repeat_on']);
            $requestData['sender_user_list'] = isset($requestData['sender_user_list']) ? json_encode($requestData['sender_user_list']) : '';
            $requestData['is_updated'] = 1;
            $reportschedule = ReportSchedule::findOrFail($id);
            $reportschedule->update($requestData);

            return redirect('admin/report-schedules')->with('session_success', 'ReportSchedule updated!');
        } catch (\Exception $e) {
            return redirect('admin/report-schedules')->with('session_error', $e->getMessage());
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
        ReportSchedule::destroy($id);

        return redirect('admin/report-schedules')->with('session_success', 'Report Schedule deleted!');
    }
}
