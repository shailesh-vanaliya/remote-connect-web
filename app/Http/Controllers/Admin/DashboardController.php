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
use App\Models\DemoMongo;
use App\Models\DataLog;
use DateTime;

class DashboardController extends Controller
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
        try {
            ini_set('memory_limit', '2048M');
            // $resultdata = DemoMongo::all();
            // $resultdata = DemoMongo::all();
            // $resultdata = DemoMongo::select('imei')->take(6);
            // $resultdata = DemoMongo::select('imei')->all()->take(60);
            $searchValue = 7.5;
            // $resultdata = DemoMongo::where('PRS_PV',"%{$searchValue}%")->get();
            $fieldName = "FLOW1";
            // $resultdata = DB::connection('mongodb')->collection('FT106')->get()->toArray();
            // $resultdata = DemoMongo::where('sysv', '=', '24.16')->first();

            $resultdata = DemoMongo::where('sysv', '24.16')->take(10)->get();

        $collection = DemoMongo::all();
        $filtered = $collection->where('dtm', 'LIKE', "%2022-05-12%");
        // $filtered = $collection->where('seq', "1818");
        $resultdata =  $filtered->toArray();


            // $resultdata = DB::connection('mongodb')->collection('FT106')->where('sysv','24.16')->get()->toArray();
            // $resultdata = DB::connection('mongodb')->collection('FT106')->take(1);
            // $resultdata = DB::connection('mongodb')->collection('FT104/')->select($fieldName)->get();
            // $resultdata = DB::connection('mongodb')->collection('FT104/')->select('PRS_PV')->where('PRS_PV','LIKE','%'.$searchValue.'%')->get();

            // $resultdata = DemoMongo::all()->take(6000);
            // $resultdata = DemoMongo::where('imei', '860987054429532')->first();
            // $resultdata = DemoMongo::where('imei', '860987054429532')->get();
            // $resultdata = DemoMongo::where('uid', '1')->get();
            // print_r(new DateTime('-1 day'));
            $start = new DateTime('-9 day');
            $stop = new DateTime('-0 day');
            // $resultdata = DemoMongo::where('dtm', '>=', new DateTime('-1 day'))->get();;
            // $resultdata = DemoMongo::whereBetween('dtm', array($start, $stop))->get();
            // $resultdata = DB::collection('860987054429532')->whereBetween('updated_at', array($start, $stop))->get();
            // echo "dddddddddddd";exit;
            // print_r($resultdata);
          
        } catch (\Exception $e) {
            echo "fdsf";exit;
            // dd($e->getMessage());
        }
       
    //    $res =  DataLog::where("modem_id", 'FT102/')->first();
 
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
        // $data['funinit']               = [''];
        $data['funinit']               = ['Dashboard.initChart()'];
        $data['locationList']               = json_encode($locationList);
        return view('admin.dashboard.dashboard', $data);

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


    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        // echo "Fsdf -> ". $action;exit;
        switch ($action) {
            case 'getDashboard':
                $this->_getDashboard();
                break;
                break;
        }
        exit;
    }


    public function _getDashboard()
    {
        // $collected_items = Device::whereNotNull('latitude')
        // ->whereNotNull('longitude')->get()->toArray();
        // $locationList = [];
        // foreach ($collected_items as $key => $values) {
        //     // print_r($values['location']);
        //     // exit;
        //     $url = url('/admin/device/device-detail/' .$values['id'] );
        //     $tempArray = array("Modem Id : " . $values['modem_id'] ." <br /> Project Name : ".  $values['project_name']." <br /> Region : ".  $values['region'] ." <br /> Location : ". $values['location']." <br />  <a href='".$url."'>".'View details' .'</a>', $values['latitude'], $values['longitude'], $values['id']);
        //     $locationList[$key] = $tempArray;
        // }
        $locationList = DB::connection('mongodb')->collection('FT106')->get();
        // print_r($locationList);
        // exit;
        // $locationList = DB::connection('mongodb')->collection('FT104/')->take(10);
        echo json_encode($locationList);
        exit;
    }
}
