<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

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

        if (!empty($keyword)) {
            $data['reportconfiguration'] = ReportConfiguration::where('report_id', 'LIKE', "%$keyword%")
                ->orWhere('device_id', 'LIKE', "%$keyword%")
                ->orWhere('organization_id', 'LIKE', "%$keyword%")
                ->orWhere('report_title', 'LIKE', "%$keyword%")
                ->orWhere('parameter', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['reportconfiguration'] = ReportConfiguration::latest()->paginate($perPage);
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
        $data['header']    = [
            'title'      => 'Report Configuration',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'Create' => '',
            ],
        ];
        return view('admin.report-configuration.create');
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
        
        ReportConfiguration::create($requestData);

        return redirect('admin/report-configuration')->with('session_error', 'ReportConfiguration added!');
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
        $data['header']    = [
            'title'      => 'Report Configuration',
            'breadcrumb' => [
                'Report Configuration'     => '',
                'edit' => '',
            ],
        ];
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
        
        $requestData = $request->all();
        
        $reportconfiguration = ReportConfiguration::findOrFail($id);
        $reportconfiguration->update($requestData);

        return redirect('admin/report-configuration')->with('session_error', 'ReportConfiguration updated!');
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

        return redirect('admin/report-configuration')->with('session_error', 'ReportConfiguration deleted!');
    }
}
