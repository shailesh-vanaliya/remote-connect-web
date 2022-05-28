<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\AlertConfigration;
use Illuminate\Http\Request;

class AlertConfigurationController extends Controller
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
        $perPage = 25;

        if (!empty($keyword)) {
            $data['alertconfigration']  = AlertConfigration::where('modem_id', 'LIKE', "%$keyword%")
                ->orWhere('parameter', 'LIKE', "%$keyword%")
                ->orWhere('condition', 'LIKE', "%$keyword%")
                ->orWhere('set_value', 'LIKE', "%$keyword%")
                ->orWhere('sms_alert', 'LIKE', "%$keyword%")
                ->orWhere('email_alert', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['alertconfigration'] = AlertConfigration::latest()->paginate($perPage);
        }
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        $data['funinit']               = ['Dashboard.initMeter()'];
        $data['header']    = [
            'title'      => 'Alert Configuration',
            'breadcrumb' => [
                'Home'     => '',
                'Alert Configuration List' => '',
            ],
        ];
        return view('admin.alert-configration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['pagetitle']             = 'Alert configuration';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        $data['header']    = [
            'title'      => 'Alert Configuration',
            'breadcrumb' => [
                'Alert Configuration'     => '',
                'create' => '',
            ],
        ];
        return view('admin.alert-configration.create', $data);
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
            $requestData['organization_id'] = 1;
            AlertConfigration::create($requestData);

            return redirect('admin/alert-configration')->with('session_success', 'Alert Configuration added!');
        } catch (\Exception $e) {
            return redirect('admin/alert-configration')->with('session_error', $e->getMessage());
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
        $data['alertconfigration'] = AlertConfigration::findOrFail($id);
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        $data['funinit']               = ['Dashboard.initMeter()'];
        $data['header']    = [
            'title'      => 'Alert Configuration',
            'breadcrumb' => [
                'Alert Configuration'     => '',
                'View' => '',
            ],
        ];
        return view('admin.alert-configration.show', $data);
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
        $data['alertconfigration'] = AlertConfigration::findOrFail($id);
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        $data['header']    = [
            'title'      => 'Alert Configuration',
            'breadcrumb' => [
                'Alert Configuration'     => '',
                'Edit' => '',
            ],
        ];
        return view('admin.alert-configration.edit', $data);
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
            $requestData['organization_id'] = 1;
            $alertconfigration = AlertConfigration::findOrFail($id);
            $alertconfigration->update($requestData);

            return redirect('admin/alert-configration')->with('session_success', 'Alert Configuration updated!');
        } catch (\Exception $e) {
            return redirect('admin/alert-configration')->with('session_error', $e->getMessage());
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
        AlertConfigration::destroy($id);

        return redirect('admin/alert-configration')->with('session_success', 'Alert Configuration deleted!');
    }
}
