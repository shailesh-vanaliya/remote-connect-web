<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use DB;
use App\Models\ReportSchedule;
use App\Models\User;
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


        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['reportschedules'] = ReportSchedule::latest()->paginate($perPage);
        } else {
            $data['reportschedules'] = ReportSchedule::latest()->paginate($perPage);
        }

        // Auth::guard('admin')->user()->organization_id

        $data['pagetitle']             = 'Report schedules';
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
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
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
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
            $data['userList'] = User::select('first_name', 'id',)->where('role', 'USER')->where('organization_id', Auth::guard('admin')->user()->organization_id)->pluck('modem_id', 'id')->toArray();
        }

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

        $requestData = $request->all();
        // print_r($requestData);
        // exit;
        $requestData['created_by'] = Auth::guard('admin')->user()->id;
        $requestData['updated_by'] = Auth::guard('admin')->user()->id;
        $requestData['repeat_on'] = json_encode($requestData['repeat_on']);
        $requestData['sender_user_list'] = isset($requestData['sender_user_list']) ? json_encode($requestData['sender_user_list']) : '';

        ReportSchedule::create($requestData);

        return redirect('admin/report-schedules')->with('session_success', 'ReportSchedule added!');
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
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
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
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
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
            $data['userList'] = User::select('first_name', 'id',)->where('role', 'USER')->where('organization_id', Auth::guard('admin')->user()->organization_id)->pluck('modem_id', 'id')->toArray();
        }
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

        $requestData = $request->all();
        $requestData['updated_by'] = Auth::guard('admin')->user()->id;
        $requestData['repeat_on'] = json_encode($requestData['repeat_on']);
        $requestData['sender_user_list'] = isset($requestData['sender_user_list']) ? json_encode($requestData['sender_user_list']) : '';

        $reportschedule = ReportSchedule::findOrFail($id);
        $reportschedule->update($requestData);

        return redirect('admin/report-schedules')->with('session_success', 'ReportSchedule updated!');
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

        return redirect('admin/report-schedules')->with('session_success', 'ReportSchedule deleted!');
    }
}
