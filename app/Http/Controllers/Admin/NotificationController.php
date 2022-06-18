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
        $table = 'device_type';
        $tableResult =  DB::getSchemaBuilder()->getColumnListing($table);
        // print_r($tableResult);
        // exit;


        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $data['notification'] = Notification::where('modem_id', 'LIKE', "%$keyword%")
                ->orWhere('alert_message', 'LIKE', "%$keyword%")
                ->orWhere('viewed', 'LIKE', "%$keyword%")
                ->orWhere('is_email_send', 'LIKE', "%$keyword%")
                ->orWhere('is_sms_send', 'LIKE', "%$keyword%")
                ->where('created_by', Auth::guard('admin')->user()->id)
                ->latest()->paginate($perPage);
        } else {
            $data['notification'] = Notification::
                where('created_by', Auth::guard('admin')->user()->id)->latest()->paginate($perPage);
        }
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/notification.js'];
        $data['funinit']               = ['Notification.init()'];
        $data['header']    = [
            'title'      => 'Notification',
            'breadcrumb' => [
                'Notification'     => '',
                'List' => '',
            ],
        ];
        return view('admin.notification.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['header']    = [
            'title'      => 'Notification',
            'breadcrumb' => [
                'Home'     => 'Notification',
                'Add' => 'Notification',
            ],
        ];
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/dashboard.js'];
        // $data['funinit']               = [''];
        // $data['funinit']               = ['Dashboard.initMeter()'];
        return view('admin.notification.create', $data);
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
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            Notification::create($requestData);

            return redirect('admin/notification')->with('session_success', 'Notification added!');
        } catch (\Exception $e) {
            return redirect('admin/notification')->with('session_error', $e->getMessage());
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
        $data['notification'] = Notification::findOrFail($id);
        $data['pagetitle']             = 'Notification';
        $data['js']                    = ['admin/notification.js'];
        $data['funinit']               = ['Notification.init()'];
        $data['header']    = [
            'title'      => 'Notification',
            'breadcrumb' => [
                'Home'     => 'Notification',
                'Show' => 'Notification',
            ],
        ];
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
        $data['header']    = [
            'title'      => 'Notification',
            'breadcrumb' => [
                'Home'     => 'Notification',
                'Edit' => 'Notification',
            ],
        ];
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
        try {
            $requestData = $request->all();
            $requestData['organization_id'] = 1;
            $notification = Notification::findOrFail($id);
            $requestData['created_by'] = Auth::guard('admin')->user()->id;
            $requestData['updated_by'] = Auth::guard('admin')->user()->id;
            $notification->update($requestData);

            return redirect('admin/notification')->with('session_success', 'Notification updated!');
        } catch (\Exception $e) {
            return redirect('admin/notification')->with('session_error', $e->getMessage());
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
            Notification::destroy($id);
            return redirect('admin/notification')->with('session_success', 'Notification deleted!');
        } catch (\Exception $e) {
            return redirect('admin/notification')->with('session_error', $e->getMessage());
        }
    }


    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        switch ($action) {
            case 'getNotification':
                $this->_getUnreadNotification();
                break;
                
            case 'readNotification':
                $this->_setReadNotification($request->all());
                break;
                
            case 'ackNotification':
                $this->_setAckNotification($request->all());
                break;
                
        }
        exit;
    }


    public function _setReadNotification($postData)
    {
       $notificationList = Notification::where('created_by', Auth::guard('admin')->user()->id)->where('id',">=",$postData['lastId'])->update(['viewed'=> 1]);
        echo json_encode($notificationList);
        exit;
    }

    public function _getUnreadNotification()
    {
        $notificationList = Notification::where('created_by', Auth::guard('admin')->user()->id)->where('viewed', 0)->orderBy('id', 'desc')->get()->toArray();
        echo json_encode($notificationList);
        exit;
    }
    public function _setAckNotification($postData)
    {
        $count = Notification::where('id',"=",$postData['notificationId'])->where(['is_ack'=> 1])->count();
        $notificationList = Notification::where('id',"=",$postData['notificationId'])->update(['is_ack'=> 1]);
        if($count == 0){
            $res['status'] = "success";
            $res['message'] = "Your message success set as acknowledged";    
        }else{
            $res['status'] = "warning";
            $res['message'] = "Your have already set as acknowledged";
        }
        
        echo json_encode($res);
        exit;
    }
}
