<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\DeviceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceTypeController extends Controller
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
            $data['devicetype'] = DeviceType::where('device_type', 'LIKE', "%$keyword%")
                ->orWhere('data_source', 'LIKE', "%$keyword%")
                ->orWhere('data_table', 'LIKE', "%$keyword%")
                ->orWhere('dashboard_id', 'LIKE', "%$keyword%")
                ->orWhere('parameter_alias', 'LIKE', "%$keyword%")
                ->orWhere('unit_alias', 'LIKE', "%$keyword%")
                ->orWhere('chart_alias', 'LIKE', "%$keyword%")
                ->orWhere('dashboard_alias', 'LIKE', "%$keyword%")
                ->orWhere('model_name', 'LIKE', "%$keyword%")
                ->orWhere('access_type', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->orWhere('updated_by', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['devicetype'] = DeviceType::latest()->paginate($perPage);
        }

        $data['title']     = 'Device Type';
        $data['pagetitle'] = 'Device Type';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Type',
            'breadcrumb' => [
                'Device Type'     => '',
                'List' => '',
            ],
        ];
        return view('admin.device-type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['title']     = 'Device Type';
        $data['pagetitle'] = 'Device Type';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Type',
            'breadcrumb' => [
                'Device Type'     => '',
                'Create' => '',
            ],
        ];
        return view('admin.device-type.create', $data);
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

        $rules = [
            "data_source" => "required",
            "data_table" => "required",
            "dashboard_id" => "required",
            "parameter_alias" => "required",
            "unit_alias" => "required",
            "chart_alias" => "required",
            "dashboard_alias" => "required",
            "model_name" => "required",
        ];

        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/device-type/create")->withErrors($validator)->withInput();
            }
            $requestData = $request->all();
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            DeviceType::create($requestData);

            return redirect('admin/device-type')->with('session_success', 'Device Type added!');
        } catch (\Exception $e) {
            return redirect('admin/device-type/create')->with('session_error', $e->getMessage());
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
        $data['devicetype'] = DeviceType::findOrFail($id);

        $data['title']     = 'Device Type';
        $data['pagetitle'] = 'Device Type';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Type',
            'breadcrumb' => [
                'Device Type'     => '',
                'View' => '',
            ],
        ];
        return view('admin.device-type.show', $data);
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
        $data['devicetype'] = DeviceType::findOrFail($id);
        $data['title']     = 'Device Type';
        $data['pagetitle'] = 'Device Type';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'Device Type',
            'breadcrumb' => [
                'Device Type'     => '',
                'Edit' => '',
            ],
        ];
        return view('admin.device-type.edit', $data);
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
        $rules = [
            "data_source" => "required",
            "data_table" => "required",
            "dashboard_id" => "required",
            "parameter_alias" => "required",
            "unit_alias" => "required",
            "chart_alias" => "required",
            "dashboard_alias" => "required",
            "model_name" => "required",
        ];

        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/device-type/$id/edit")->withErrors($validator)->withInput();
            }
            $requestData = $request->all();

            $devicetype = DeviceType::findOrFail($id);
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $devicetype->update($requestData);

            return redirect('admin/device-type')->with('session_success', 'Device Type updated!');
        } catch (\Exception $e) {
            return redirect("admin/device-type/$id/edit")->with('session_error', $e->getMessage());
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
        try {
            DeviceType::destroy($id);
            return redirect('admin/device-type')->with('session_success', 'Device Type deleted!');
        } catch (\Exception $e) {
            return redirect("admin/device-type")->with('session_error', $e->getMessage());
        }
    }
}
