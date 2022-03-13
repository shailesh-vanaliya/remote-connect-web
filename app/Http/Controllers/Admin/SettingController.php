<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Settings;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function edit(Request $request)
    {
        $settings = Settings::first();
        $data = $request->all();
        if ($data) {
            $request->validate([
                'email' => 'required|max:255'
            ]);
            if ($settings) {
                $settings->update($data);
            } else {
                Settings::create($data);
            }
        }

        $data['title']     = 'Settings';
        $data['pagetitle']  = 'Settings';
        $data['header']    = [
            'title'      => 'Settings',
            'breadcrumb' => [
                'Home'     => '',
                'Settings' => '',
            ],
        ];

        return view('admin.setting.setting', $data, compact('settings'));
    }

    public function profile(Request $request)
    {

        $user = Auth::guard('admin')->user();

        if ($user) {
            $userId              = $user->id;
            $data['userDetails'] = $user;

            if ($request->isMethod('post')) {
                $formData = $request->all();
                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'email' => 'required',
                ];

                if (isset($formData['image'])) {
                    $rules['image'] =  'image|mimes:jpeg,png,jpg|max:2048';
                }
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return redirect(route('profile'))->withErrors($validator)->withInput();
                }

                $user->update($formData);
                $request->session()->flash('session_success', 'Profile Updated successfully.');

                return redirect(route('profile'));
            }

            $data['title']     = 'Edit Profile';
            $data['pagetitle'] = 'Edit Profile';
            $data['userId']    = $userId;
            $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
            $data['funinit']   = ['User.init()'];
            $data['header']    = [
                'title'      => 'Edit Profile',
                'breadcrumb' => [
                    'Home'     => 'Edit Profile',
                    'Settings' => 'Edit Profile',
                ],
            ];
            return view('admin.profile.profile', $data);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changepwd(Request $request)
    {
        $user = Auth::guard('admin')->user();

        if ($user) {
            $userId = $user->id;
            $userDetails = $user;

            if ($request->isMethod('post')) {
                $password_data = $userDetails->password;
                $password = $request['password'];
                $validator = Validator::make($request->all(), [
                    'password' => 'required|different:new_password',
                    'new_password' => 'required|different:password',
                    'confirm_password' => 'required|same:new_password',
                ]);
                if ($validator->fails()) {
                    return redirect(route('profile', ['type' => 'changepassword']))->withErrors($validator)->withInput();
                }
                if (Hash::check($password, $password_data)) {
                    $userDetails->password = Hash::make($request->get('new_password'));
                    $userDetails->save();
                    $request->session()->flash('session_success', 'Password SuccessFully Change');

                    return redirect(route('profile', ['type' => 'changepassword']));
                }
                $request->session()->flash('session_error', 'Old Password does not match');
                return redirect(route('profile', ['type' => 'changepassword']));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function setting(Request $request)
    {

        $user = Auth::guard('admin')->user();

        $data['permission'] = Settings::where('id','>', 1)->get();
        if ($user) {
            $userId              = $user->id;
            $data['userDetails'] = $user;

            if ($request->isMethod('post')) {
                try {
                    $formData = $request->all();
                    foreach ($formData['permission'] as $key => $val) {

                        $res =  Settings::where(['field_key' =>  $val])->update([
                            'field_value' =>  $formData['field_key'][$key],
                        ]);
                    }
                    $request->session()->flash('session_success', 'Setting Updated successfully.');

                    return redirect(route('setting'));
                } catch (\Exception $e) {
                    $request->session()->flash('session_error', $e->getMessage());
                    return redirect(route('setting'));
                }
            }

            $data['title']     = 'Edit Setting';
            $data['pagetitle'] = 'Edit Setting';
            $data['userId']    = $userId;
            $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
            $data['funinit']   = ['User.init()'];
            $data['header']    = [
                'title'      => 'Edit Setting',
                'breadcrumb' => [
                    'Home'     => 'Edit Setting',
                    'Settings' => 'Edit Setting',
                ],
            ];
            return view('admin.update_setting', $data);
        } else {
            return redirect()->route('login');
        }
    }

    public function rebootServer(Request $request)
    {
        try {
            $urls =  str_replace(url('/admin/'),"",$_SERVER['HTTP_REFERER']);
            Settings::where(['field_key' =>  'server_reboot'])->update(['field_value' =>  1]);
            $request->session()->flash('session_success', 'Server Reboot Successfully');
            return Redirect::to($_SERVER['HTTP_REFERER']);
            // return redirect(route('setting'));
        } catch (\Exception $e) {
            $request->session()->flash('session_error', $e->getMessage());
        }
        return redirect()->route('login');
    }

}
