<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Auth;
use DB;
use Exception;
use Hash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\Device;
use App\Models\Report;
use App\Models\AlertConfigration;

// use \PhpMqtt\Client\MqttClient;
// use \PhpMqtt\Client\ConnectionSettings;
// use PhpMqtt\Client\Facades\MQTT;
// use App\Http\Controllers\Admin\phpMQTT;
// require('./phpMQTT.php');
// require_once(app_path() . '/Http/Controllers/Admin/phpMQTT.php');
use PhpMqtt\Client\Facades\MQTT;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {

        $reportObj = new Report();
        $data['reportCount'] = $reportObj->getReportsData('count');

        $deviceObj = new Device();
        $device = $deviceObj->getDeviceByUser();
 
        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        $data['funinit']               = ['Dashboard.init()'];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['alertCount'] = AlertConfigration::count();
        }  else {
            $data['alertCount'] = AlertConfigration::where('created_by', Auth::guard('admin')->user()->id)->count();
        }
        $data['device'] =  $device->count();
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $onlineDevice =  Device::select(
                'device_map.MQTT_ID',
                'device_map.max_user_access',
                'device_map.IMEI_No',
                'device_status.Status',
                'remote.MACHINE_NO',
                'remote.MACHINE_LOCAL_IP',
                'remote.MACHINE_LOCAL_PORT',
                'remote.MACHINE_REMOTE_PORT',
                'device_map.subscription_status',
                'device_type.device_type',
                'devices.*',
            );
            $onlineDevice->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $onlineDevice->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $onlineDevice->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $onlineDevice->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $onlineDevice->where('device_status.Status',1);
            $onlineDevice->groupBy('devices.id');
            $data['onlineDevice'] =  $onlineDevice->count();
            
        } else {
            $onlineDevice =  Device::select(
                'device_map.MQTT_ID',
                'device_map.max_user_access',
                'device_map.subscription_status',
                'device_map.IMEI_No',
                'device_status.Status',
                'device_type.device_type',
                'devices.*',
            );
         
            $onlineDevice->where('devices.created_by', Auth::guard('admin')->user()->id);
            $onlineDevice->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $onlineDevice->Join('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $onlineDevice->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $onlineDevice->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $onlineDevice->where('device_status.Status',1);
            $onlineDevice->groupBy('devices.id');
            $data['onlineDevice'] =  $onlineDevice->get()->toArray();
            $data['onlineDevice'] = count($data['onlineDevice']);
       
        }
 
        return view('admin.dashboard', $data);

        // $server   = 'm2m.iiotconnect.in';
        // $port     = 1883;
        // $client_id = 'shailesh-Sub';
        // $username = 'shailesh';
        // $password = 'shailesh';
        // $clean_session = true;

        // $connectionSettings  = new ConnectionSettings();
        // $connectionSettings
        //     ->setUsername($username)
        //     ->setPassword($password)
        //     ->setKeepAliveInterval(60)
        //     ->setLastWillTopic('shailesh/zzz')
        //     ->setLastWillMessage('client disconnect')
        //     ->setLastWillQualityOfService(1);


        // $mqtt = new MqttClient($server, $port, $client_id);

        // $mqtt->connect($connectionSettings, $clean_session);
        // printf("client connected\n");

        // $mqtt->subscribe('emqx/test', function ($topic, $message) {
        //     printf("Received message on topic [%s]: %s\n", $topic, $message);
        // }, 0);

        // for ($i = 0; $i < 10; $i++) {
        //     $payload = array(
        //         'protocol' => 'tcp',
        //         'date' => date('Y-m-d H:i:s'),
        //         'url' => 'https://github.com/emqx/MQTT-Client-Examples'
        //     );
        //     $mqtt->publish(
        //         // topic
        //         'emqx/test',
        //         // payload
        //         json_encode($payload),
        //         // qos
        //         0,
        //         // retain
        //         true
        //     );
        //     printf("msg $i send\n");
        //     sleep(1);
        // }

        // $mqtt->loop(true);
    }
 
    
}
