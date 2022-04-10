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

        // try {


        //     $eeee = MQTT::publish('shailesh/1', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/2', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/3', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/4', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/5', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/6', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/7', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/8', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        //     $eeee = MQTT::publish('shailesh/9', '{"data":"1","user":"Login Email id","timestamp":"2022-03-05 11:29:38.865053","Modem id":"*MODEM_ID"}');
        // } catch (\Exception $e) {
        //     dd($e->getMessage());
        // }



        // echo app_path() . '\Http\Controllers\Admin\phpMQTT.php';exit;

        //         $server   = 'm2m.iiotconnect.in';
        //         $port     = 1883;
        //         // $client_id = 'shailesh';
        //         $client_id = 'shailesh-Sub';
        //         $username = 'shailesh';
        //         $password = 'shailesh';
        //         $mqtt = new phpMQTT($server, $port, $client_id);
        //         // $mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

        //         if ($mqtt->connect(true, NULL, $username, $password)) {
        //             $mqtt->publish('shailesh/', 'Hello World! at sssssssssss ' . date('r'), 0, false);
        //             $mqtt->close();
        //         } else {
        //             echo "Time out!\n";
        //         }
        //       echo "Fsdfsdfsdf";
        //       exit;

        // MQTT::publish('some/topic', 'Hello World!');


        $locationList = array(
            array('chandigarh', 30.7333, 76.7794, 8),
            array('Panjab', 31.1471, 75.3412, 6),
            array('Ahmadabad', 23.0225, 72.5714, 4),
            array('Baroda', 22.3072, 73.1812, 5),
            array('chennai', 13.0827, 80.2707, 3),
            array('bangalore', 12.9716, 77.5946, 2),
            array('mumbai', 19.0760, 72.8777, 1)
        );
        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        $data['funinit']               = ['Dashboard.init()'];
        $data['locationList']               = json_encode($locationList);
        // print_r($data['locationList'] );
        // exit;
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
