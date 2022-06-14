<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendSmtpMail;
use App\Models\Customer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Organization;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $perPage = 25;

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['users'] = User::select('users.*')
                ->where('users.role', User::ROLES['ADMIN'])
                ->orWhere('users.role', User::ROLES['USER'])
                ->orWhere('users.role', User::ROLES['ENG'])
                ->latest('created_at')
                ->get();
        } else {
            $data['users'] = User::select('users.*')
                // ->where('users.role', User::ROLES['ADMIN'])
                ->orWhere('users.role', User::ROLES['USER'])
                // ->orWhere('users.role', User::ROLES['ENG'])
                ->where('organization_id', Auth::guard('admin')->user()->organization_id)
                ->latest('created_at')
                ->get();
        }

        $data['header'] = [
            'title' => 'Users List',
            'breadcrumb' => [
                'Home' => route('admin_dashboard'),
                'Users' => '',
                'List' => '',
            ],
        ];
        $data['pagetitle'] = 'Users List';
        $data['title'] = 'Users List';
        return view('admin/users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        if ($requestData) {
            $validate = $this->validator($requestData);
            $validate->validate();
            // $customers = $this->checkUserExistInCryodb($requestData['email']);
            $user                 = new User();
            $user->first_name     = $requestData['first_name'];
            $user->full_name     = $requestData['first_name'];
            $user->email          = $requestData['email'];
            $user->last_name      = $requestData['last_name'];
            $user->mobile_no          = $requestData['mobile_no'];
            $user->role          = $requestData['role'];
            $user->status          = $requestData['status'];
            $user->storage_usage          = isset($requestData['storage_usage']) ?$requestData['storage_usage'] : 0;
            $user->storage_quota          = isset($requestData['storage_quota']) ?$requestData['storage_quota'] : 0;
            $user->report_counter          = isset($requestData['report_counter']) ?$requestData['report_counter'] : 0;
            $user->report_quota          = isset($requestData['report_quota']) ?$requestData['report_quota'] : 0;
            $user->sms_counter          = isset($requestData['sms_counter']) ?$requestData['sms_counter'] : 0;
            $user->sms_quota          = isset($requestData['sms_quota']) ?$requestData['sms_quota'] : 0;
            $user->email_counter          = isset($requestData['email_counter']) ?$requestData['email_counter'] : 0;
            $user->email_quota          = isset($requestData['email_quota']) ?$requestData['email_quota'] : 0;
            $user->notification_counter          = isset($requestData['notification_counter']) ?$requestData['notification_counter'] : 0;
            $user->notification_quota          = isset($requestData['notification_quota']) ?$requestData['notification_quota'] : 0;
            $user->organization_id          = $requestData['organization_id'];
            $user->sms_alert = (isset($requestData['sms_alert']) && $requestData['sms_alert'] == 'on') ? 1 : 0;
            $user->email_report = (isset($requestData['email_report']) &&  $requestData['email_report'] == 'on') ? 1 : 0;
            $user->email_alert = (isset($requestData['email_alert']) &&  $requestData['email_alert'] == 'on') ? 1 : 0;
            $user->password       = Hash::make($requestData['password']);
            $user->save();
            $user =  $requestData;
            $details = [
                'title' => 'You are register successfully',
                'body' => 'Hello ',
                'mailTitle' => 'register',
                'subject' => 'You are register in Futuristic Technologies',
                'data' =>  $user,
            ];
            $res =   \Mail::to('testshailesh1@gmail.com')->send(new \App\Mail\SendSmtpMail($details));

            // $res =  Mail::to('testshailesh1@gmail.com')->send(new SendSmtpMail(['template' => 'emails.welcome-admin', 'data' => ['user' => $user, 'email' => $requestData['email'], 'password' => $requestData['password']]]));
            return redirect('admin/users')->with('session_success', 'New User created successfully!');
        }

        return view('admin.users.create');
    }

    public function create()
    {
        $data['header'] = [
            'title' => 'Users Create',
            'breadcrumb' => [
                'Home' => route('admin_dashboard'),
                'Users' => '',
                'List' => '',
            ],
        ];
        $data['pagetitle'] = 'Users Create';
        $data['title'] = 'Users Create';
        $data['header']    = [
            'title'      => 'Users ',
            'breadcrumb' => [
                'Users '     => '',
                'Create' => '',
            ],
        ];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        } else {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        }
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        return view('admin.users.create', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $data['user'] = User::findOrFail($id);

        $data['header'] = [
            'title' => 'Show user details',
            'breadcrumb' => [
                'Home' => route('admin_dashboard'),
                'Users' => '',
                'details' => '',
            ],
        ];
        $data['pagetitle'] = 'Show user details';
        $data['title'] = 'Show user details';
        return view('admin/users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $user        = User::findOrFail($id);
        $requestData = $request->all();
        if ($requestData) {
            $validate = $this->validator($requestData, 'edit');
            $validate->validate();
            $user->first_name = $requestData['first_name'];
            $user->last_name  = $requestData['last_name'];
            $user->mobile_no = $requestData['mobile_no'];
            // $user->email = $requestData['email'];
            $user->status = $requestData['status'];
            $user->role = $requestData['role'];
            $user->organization_id          = $requestData['organization_id'];
            $user->storage_usage          = isset($requestData['storage_usage']) ?$requestData['storage_usage'] : 0;
            $user->storage_quota          = isset($requestData['storage_quota']) ?$requestData['storage_quota'] : 0;
            $user->report_counter          = isset($requestData['report_counter']) ?$requestData['report_counter'] : 0;
            $user->report_quota          = isset($requestData['report_quota']) ?$requestData['report_quota'] : 0;
            $user->sms_counter          = isset($requestData['sms_counter']) ?$requestData['sms_counter'] : 0;
            $user->sms_quota          = isset($requestData['sms_quota']) ?$requestData['sms_quota'] : 0;
            $user->email_counter          = isset($requestData['email_counter']) ?$requestData['email_counter'] : 0;
            $user->email_quota          = isset($requestData['email_quota']) ?$requestData['email_quota'] : 0;
            $user->notification_counter          = isset($requestData['notification_counter']) ?$requestData['notification_counter'] : 0;
            $user->notification_quota          = isset($requestData['notification_quota']) ?$requestData['notification_quota'] : 0;
            
            $user->sms_alert = (isset($requestData['sms_alert']) && $requestData['sms_alert'] == 'on') ? 1 : 0;
            $user->email_report = (isset($requestData['email_report']) &&  $requestData['email_report'] == 'on') ? 1 : 0;
            $user->email_alert = (isset($requestData['email_alert']) &&  $requestData['email_alert'] == 'on') ? 1 : 0;
            $user->save();
            return redirect('admin/users')->with('session_success', 'User updated successfully!');
            // return redirect()->route('user_list', ['id' => $id])->with('status', 'User updated successfully!')->with('type', 'success');
        }

        return view('admin/users.edit', compact('user'));
    }
    public function edit(Request $request, $id)
    {
        $user        = User::findOrFail($id);
        $requestData = $request->all();

        if ($requestData) {

            $validate = $this->validator($requestData, 'edit');
            $validate->validate();
            $user->first_name = $requestData['first_name'];
            $user->last_name  = $requestData['last_name'];
            $user->mobile_no = $requestData['mobile_no'];
            // $user->email = $requestData['email'];
            $user->status = $requestData['status'];
            $user->role = $requestData['role'];
            $user->save();
            return redirect('admin/users')->with('session_success', 'User updated successfully!');
            // return redirect()->route('user_list', ['id' => $id])->with('status', 'User updated successfully!')->with('type', 'success');
        }
        $data['header']    = [
            'title'      => 'Users ',
            'breadcrumb' => [
                'Users '     => '',
                'Update' => '',
            ],
        ];
        $data['plugincss']               = ['icheck-bootstrap/icheck-bootstrap.min.css'];
        $data['user']        = User::findOrFail($id);
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        } else {
            $data['organization'] = Organization::select('organization_name', 'id',)->pluck('organization_name', 'id')->toArray();
        }
        return view('admin/users.edit', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('user_list')->with('status', 'User deleted successfully!')->with('type', 'success');
    }

    public function editProfile(Request $request, $id)
    {
        $authuser = Auth::user();
        $user     = User::findOrFail($id);

        if ($authuser->id == $user->id) {
            $requestData = $request->all();
            if ($requestData) {
                $validate = $this->validator($requestData, 'edit');
                $validate->validate();
                //$user->first_name = $requestData['first_name'];
                //$user->last_name  = $requestData['last_name'];
                //$user->phone      = $requestData['phone'];
                $user->full_name = $requestData['full_name'];
                $user->mobile_no = $requestData['mobile_no'];
                $user->email      = $requestData['email'];
                $user->save();

                return redirect()->route('edit_profile', ['id' => $id])->with('status', 'Profile updated successfully!')->with('type', 'success');
            }

            return view('admin/users.profile', compact('user'));
        }

        return redirect()->route('dashboard')->with('status', 'You do not have rights to edit this profile!')->with('type', 'warning');
    }

    public function changePassword(Request $request)
    {
        $user        = Auth::user();
        $requestData = $request->all();
        if ($requestData) {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with('error', 'Your current password does not matches with the password you provided. Please try again.');
            }

            if (0 == strcmp($request->get('current-password'), $request->get('new-password'))) {
                //Current password and new password are same
                return redirect()->back()->with('error', 'New Password cannot be same as your current password. Please choose a different password.');
            }

            $validatedData = $request->validate([
                'current-password' => 'required',
                'new-password'     => 'required|string|min:6|confirmed',
            ]);

            //Change Password

            $user->password = bcrypt($request->get('new-password'));
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully !');
        }

        return view('admin/users.changepassword', compact('user'));
    }

    protected function validator(array $data, $mode = 'create')
    {
        if ('create' == $mode) {
            $validators = [
                'first_name'            => ['required', 'string', 'max:255'],
                'last_name'             => ['required', 'string', 'max:255'],
                // 'full_name'             => ['required', 'string', 'max:255'],
                'mobile_no'             => ['required', 'string', 'min:10'],
                'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'              => ['required', 'min:6', 'confirmed'],
                'password_confirmation' => ['required', 'min:6'],
            ];
        } else {
            $validators = [
                // 'full_name' => ['required', 'string', 'max:255'],
                'mobile_no'  => ['required', 'string', 'min:10'],
            ];
        }

        return Validator::make($data, $validators);
    }

    public function statusChange(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->get('status') == 'active') {
            $user->verified = 1;
            $user->save();
        } else {
            $user->verified = 0;
            $user->save();
        }

        return redirect()->route('user_list')->with('status', 'User status changed successfully!')->with('type', 'success');
    }

    public function seller(Request $request)
    {

        $data['users'] = User::select('users.*')
            ->orWhere('users.role', User::ROLES['SELLER'])
            ->latest('created_at')->get();
        $data['header'] = [
            'title' => 'Seller List',
            'breadcrumb' => [
                'Home' => route('admin_dashboard'),
                'Seller' => route('user_list'),
                'Seller' => '',
            ],
        ];
        $data['pagetitle'] = 'Seller List';
        $data['title'] = 'Seller List';
        return view('admin/users.seller', $data);
    }
}
