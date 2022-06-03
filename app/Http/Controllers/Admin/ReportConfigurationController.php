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
            $data['reportconfiguration'] = ReportConfiguration::latest()->get();
        } else {
            $data['reportconfiguration'] = ReportConfiguration::where('created_by', Auth::guard('admin')->user()->id)->latest()->get();
        }

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
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['header']    = [
            'title'      => 'Report Configuration',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'Create' => '',
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
        $table = 'datalog';

        $data['column'] =  DB::connection('mysql2')->getSchemaBuilder()->getColumnListing($table);

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
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $requestData['parameter'] = json_encode($requestData['parameter']);
            // print_r($requestData);
            // exit;
            ReportConfiguration::create($requestData);

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
        $data['js']                    = ['admin/report.js'];
        $data['funinit']               = ['Report.init()'];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
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
            $data['device'] = Device::select('modem_id', 'id',)->where('created_by', Auth::guard('admin')->user()->id)->pluck('modem_id', 'id')->toArray();
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
            $data['deviceType'] = DeviceType::select('device_type', 'id',)->pluck('device_type', 'id')->toArray();
        }
        $table = 'datalog';
        $data['column'] =  DB::connection('mysql2')->getSchemaBuilder()->getColumnListing($table);

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
            $reportconfiguration->update($requestData);

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
}
