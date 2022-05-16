<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
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
            $data['organization'] = Organization::where('organization_name', 'LIKE', "%$keyword%")
                ->orWhere('user_count', 'LIKE', "%$keyword%")
                ->orWhere('device_count', 'LIKE', "%$keyword%")
                ->orWhere('max_device_limit', 'LIKE', "%$keyword%")
                ->orWhere('max_user_limit', 'LIKE', "%$keyword%")
                ->orWhere('created_by', 'LIKE', "%$keyword%")
                ->orWhere('updated_by', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['organization'] = Organization::latest()->paginate($perPage);
        }
        $data['pagetitle']             = 'Organization';
        $data['js']                    = ['admin/organization.js'];
        $data['funinit']               = [''];
        $data['header']    = [
            'title'      => 'Organizaion',
            'breadcrumb' => [
                'Organization'     => '',
                'list' => '',
            ],
        ];
        return view('admin.organization.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['pagetitle']             = 'Organization';
        $data['js']                    = ['admin/organization.js'];
        $data['funinit']               = [''];
        $data['header']    = [
            'title'      => 'Organizaion',
            'breadcrumb' => [
                'Home'     => 'Organizaion',
                'Create New Organization' => 'Create New Organization',
            ],
        ];
        return view('admin.organization.create',$data);
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
        $requestData['created_by'] = Auth::guard('admin')->user()->id;
        $requestData['updated_by'] = Auth::guard('admin')->user()->id;
        Organization::create($requestData);

        return redirect('admin/organization')->with('session_success', 'Organization added!');
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
        $data['organization'] = Organization::findOrFail($id);
        $data['pagetitle']             = 'Organization';
        $data['js']                    = ['admin/organization.js'];
        $data['funinit']               = [''];
        $data['header']    = [
            'title'      => 'Organizaion',
            'breadcrumb' => [
                'Organization'     => 'Organizaion',
                'View' => 'Organizaion',
            ],
        ];
        return view('admin.organization.show', $data);
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
        $data['organization'] = Organization::findOrFail($id);
        $data['pagetitle']             = 'Organization';
        $data['js']                    = ['admin/organization.js'];
        $data['funinit']               = [''];
        $data['header']    = [
            'title'      => 'Organizaion',
            'breadcrumb' => [
                'Home'     => 'Organizaion',
                'Settings' => 'Organizaion',
            ],
        ];
        return view('admin.organization.edit', $data);
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
        $organization = Organization::findOrFail($id);
        $organization->update($requestData);

        return redirect('admin/organization')->with('session_success', 'Organization updated!');
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
        Organization::destroy($id);

        return redirect('admin/organization')->with('session_success', 'Organization deleted!');
    }
}
