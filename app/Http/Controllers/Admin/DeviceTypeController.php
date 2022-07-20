<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\DeviceType;
use Illuminate\Http\Request;

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
            $devicetype = DeviceType::where('device_type', 'LIKE', "%$keyword%")
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
            $devicetype = DeviceType::latest()->paginate($perPage);
        }

        return view('admin.device-type.index', compact('devicetype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.device-type.create');
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
        
        DeviceType::create($requestData);

        return redirect('admin/device-type')->with('session_success', 'DeviceType added!');
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
        $devicetype = DeviceType::findOrFail($id);

        return view('admin.device-type.show', compact('devicetype'));
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
        $devicetype = DeviceType::findOrFail($id);

        return view('admin.device-type.edit', compact('devicetype'));
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
        
        $devicetype = DeviceType::findOrFail($id);
        $devicetype->update($requestData);

        return redirect('admin/device-type')->with('session_success', 'DeviceType updated!');
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
        DeviceType::destroy($id);

        return redirect('admin/device-type')->with('session_success', 'DeviceType deleted!');
    }
}
