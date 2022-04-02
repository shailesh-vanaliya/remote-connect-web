<?php

namespace App\Http\Controllers\Login;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {

        $data['pagetitle'] = 'Login';
        $data['plugincss'] = [];
        $data['css'] = [''];
        $data['pluginjs'] = ['public/assets/js/jquery.validate.min.js'];
        $data['js'] = ['public/assets/js/login.js'];
        $data['funinit'] = ['login.initlogin()'];
        $data['activateValue'] = 'Staff';
        $data['header'] = [
            'title' => 'Login',
            'breadcrumb' => [
                // 'Home' => route('login'),
                'Login' => '',
            ],
        ];

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect(route('login'))->withErrors($validator)->withInput();
            }
            try {
                $email = $request->input('email');
                $password = $request->input('password');
                $objUsers = new User();
                if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'Active'])) {
                    $user = User::Where(['email' => $email, 'status' => 'Active'])->first();
 
                    // if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'Active', 'role' => 'SUPERADMIN'])) {
                    $request->session()->flash('session_success', 'Welcome ' . $user['full_name'] . " " . "..!");
                    return redirect(route('admin_dashboard'));
                } elseif (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'Active', 'role' => 'ADMIN'])) {
                    //     $request->session()->flash('session_success', 'Logged in successfully..!');
                    //     return redirect(route('admin_dashboard'));
                    // }elseif (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password, 'status' => 'Active', 'role' => 'USER'])) {
                    //     $request->session()->flash('session_success', 'Logged in successfully..!');
                    //     return redirect(route('admin_dashboard'));
                } else {
                    $user = User::Where(['email' => $email, 'status' => 'Active'])->first();
                    if (!$user) {
                        $request->session()->flash('session_error', 'Incorrect Email or Your account is Inactive.');
                    } else {
                        $request->session()->flash('session_error', 'Incorrect Password.');
                    }
                }
            } catch (\Exception $e) {
                $request->session()->flash('session_error', $e->getMessage());
            }
        }
        $data['name'] = [];
        return view('login.login', $data);
    }

    public function register(Request $request)
    {

        $data['pagetitle'] = 'Login';
        $data['plugincss'] = [];
        $data['css'] = [''];
        $data['pluginjs'] = ['public/assets/js/jquery.validate.min.js'];
        $data['js'] = ['public/assets/js/login.js'];
        $data['funinit'] = ['login.initlogin()'];
        $data['activateValue'] = 'Staff';
        $data['header'] = [
            'title' => 'Login',
            'breadcrumb' => [
                // 'Home' => route('login'),
                'Login' => '',
            ],
        ];

        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                'first_name' => 'required',
                'last_name' => 'required',
                'mobile_no' => 'required|numeric',
                'confirm_password' => 'same:password|min:6'

            ]);

            if ($validator->fails()) {
                return redirect(route('register'))->withErrors($validator)->withInput();
            }
            try {
                $requestData = $request->all();

                $user                 = new User();
                $user->first_name     = $requestData['first_name'];
                $user->full_name     = $requestData['first_name'];
                $user->email          = $requestData['email'];
                $user->last_name      = $requestData['last_name'];
                $user->mobile_no          = $requestData['mobile_no'];
                $user->role          = "USER";
                $user->status          = "Active";
                $user->password       = Hash::make($requestData['password']);
                $user->save();

                // $user = User::Where(['email' => $email, 'status' => 'Active'])->first();
                if ($user) {
                    $request->session()->flash('session_success', 'Your registration successfully done');
                    return redirect(route('login'));
                } else {
                    $request->session()->flash('session_error', 'Something went wrong.');
                }
            } catch (\Exception $e) {
                $request->session()->flash('session_error', $e->getMessage());
            }
        }
        $data['name'] = [];
        return view('login.register', $data);
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('admin')->logout();
            Auth::guard('user')->logout();
            if (!empty(Auth::guard('admin')->user()) || !empty(Auth::guard('user'))) {
                Auth::logout();
                Auth::guard('admin')->logout();
                Auth::guard('user')->logout();

                $request->session()->flash('session_success', 'You have successfully Logged Out.');
            } else {
                $request->session()->flash('session_success', 'You have successfully Logged Out');
            }
        } catch (\Exception $e) {
            $request->session()->flash('session_error', $e->getMessage());
        }
        return redirect()->route('login');
    }
}
