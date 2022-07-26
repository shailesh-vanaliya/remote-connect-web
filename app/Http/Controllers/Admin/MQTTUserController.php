<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\MQTTUser;
use Illuminate\Http\Request;

class MQTTUserController extends Controller
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
            $data['mqttuser'] = MQTTUser::where('user_name', 'LIKE', "%$keyword%")
                ->orWhere('password', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $data['mqttuser'] = MQTTUser::latest()->paginate($perPage);
        }
        $data['title']     = 'MQTT User';
        $data['pagetitle'] = 'MQTT User';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'MQTT User',
            'breadcrumb' => [
                'MQTT User'     => '',
                'List' => '',
            ],
        ];
        return view('admin.mqtt-user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['title']     = 'MQTT User';
        $data['pagetitle'] = 'MQTT User';
        $data['js']        = ['admin/mqttUser.js'];
        $data['funinit']   = ['MqttUser.init()'];
        $data['header']    = [
            'title'      => 'MQTT User',
            'breadcrumb' => [
                'MQTT User'     => '',
                'Create' => '',
            ],
        ];
        return view('admin.mqtt-user.create', $data);
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
            "user_name" => "required",
            "password" => "required",
        ];

        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/mqtt-user/create")->withErrors($validator)->withInput();
            }
            $requestData = $request->all();

            MQTTUser::create($requestData);

            return redirect('admin/mqtt-user')->with('session_success', 'MQTTUser added!');
        } catch (\Exception $e) {
            return redirect('admin/mqtt-user/create')->with('session_error', $e->getMessage());
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
        $date['mqttuser'] = MQTTUser::findOrFail($id);
        $data['title']     = 'MQTT User';
        $data['pagetitle'] = 'MQTT User';
        $data['js']        = ['admin/user.js', 'jquery.validate.min.js'];
        $data['funinit']   = ['User.init()'];
        $data['header']    = [
            'title'      => 'MQTT User',
            'breadcrumb' => [
                'MQTT User'     => '',
                'View' => '',
            ],
        ];
        return view('admin.mqtt-user.show', $data);
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
        $data['mqttuser'] = MQTTUser::findOrFail($id);
        $data['title']     = 'MQTT User';
        $data['pagetitle'] = 'MQTT User';
        $data['js']        = ['admin/mqttUser.js'];
        $data['funinit']   = ['MqttUser.init()'];
        $data['header']    = [
            'title'      => 'MQTT User',
            'breadcrumb' => [
                'MQTT User'     => '',
                'Edit' => '',
            ],
        ];
        return view('admin.mqtt-user.edit', $data);
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
            "user_name" => "required",
        ];
        try {
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect("admin/mqtt-user/$id/edit")->withErrors($validator)->withInput();
            }

        $requestData = $request->all();
        // print_r($requestData);exit;
        
        // $passworda = $requestData['password'];
        // $password_hex_sha512 = $requestData['password_hex_sha512'];
        // $password_b64_sha512 = $requestData['password_b64_sha512'];
        // // exit;
        // $password = password_hash($passworda, PASSWORD_BCRYPT);
        // echo $password . " === <br/>";

        // $password1 = password_hash($password_hex_sha512, PASSWORD_BCRYPT);
        // echo $password1 . " === <br/>";
        // $password1 = password_hash($password_b64_sha512, PASSWORD_BCRYPT);
        // echo $password1 . " === <br/>";

        // exit;
        // $hash = hash('sha512', $requestData['password']);
        $hash = password_hash(hash('sha512', $requestData['password']), PASSWORD_DEFAULT);
        // $hash = password_hash($requestData['password'], PASSWORD_DEFAULT);
        
        $mqttuser = MQTTUser::findOrFail($id);
        $requestData['password'] = (!empty($requestData['password']) ) ?  $hash : $requestData['old_password'];

        $mqttuser->update($requestData);

        return redirect('admin/mqtt-user')->with('session_success', 'MQTTUser updated!');
    } catch (\Exception $e) {
        return redirect("admin/mqtt-user/$id/edit")->with('session_error', $e->getMessage());
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
        MQTTUser::destroy($id);

        return redirect('admin/mqtt-user')->with('session_success', 'MQTTUser deleted!');
    }
}
