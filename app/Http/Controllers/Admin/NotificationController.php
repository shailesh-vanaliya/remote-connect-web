<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use DB;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $table = 'device_type';
        $tableResult =  DB::getSchemaBuilder()->getColumnListing($table);
// print_r($tableResult);
// exit;
    

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data['notification'] = Notification::where('modem_id', 'LIKE', "%$keyword%")
                ->orWhere('alert_message', 'LIKE', "%$keyword%")
                ->orWhere('is_read', 'LIKE', "%$keyword%")
                ->orWhere('is_email_send', 'LIKE', "%$keyword%")
                ->orWhere('is_sms_send', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['notification'] = Notification::latest()->paginate($perPage);
        }
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        return view('admin.notification.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        return view('admin.notification.create',$data);
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
        $requestData['organization_id'] = 1;
        Notification::create($requestData);

        return redirect('admin/notification')->with('session_success', 'Notification added!');
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
        $data['notification'] = Notification::findOrFail($id);
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        return view('admin.notification.show', $data);
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
        $data['notification'] = Notification::findOrFail($id);
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        return view('admin.notification.edit', $data);
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
        $requestData['organization_id'] = 1;
        $notification = Notification::findOrFail($id);
        $notification->update($requestData);

        return redirect('admin/notification')->with('session_success', 'Notification updated!');
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
        Notification::destroy($id);

        return redirect('admin/notification')->with('session_success', 'Notification deleted!');
    }
}
