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
            $reportconfiguration = ReportConfiguration::where('report_id', 'LIKE', "%$keyword%")
                ->orWhere('device_id', 'LIKE', "%$keyword%")
                ->orWhere('organization_id', 'LIKE', "%$keyword%")
                ->orWhere('report_title', 'LIKE', "%$keyword%")
                ->orWhere('parameter', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $reportconfiguration = ReportConfiguration::latest()->paginate($perPage);
        }

        return view('admin.report-configuration.index', compact('reportconfiguration'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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
        $reportconfiguration = ReportConfiguration::findOrFail($id);

        return view('admin.report-configuration.show', compact('reportconfiguration'));
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
        $reportconfiguration = ReportConfiguration::findOrFail($id);

        return view('admin.report-configuration.edit', compact('reportconfiguration'));
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
