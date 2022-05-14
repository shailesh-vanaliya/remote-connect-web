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
// use DateTime;
use Carbon\Carbon;

class MeterDashboardController extends Controller
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
            // $searchValue = 7.5;
            // $resultdata = DemoMongo::where('PRS_PV',"%{$searchValue}%")->get();
            // $fieldName = "FLOW1";
            // $resultdata = DB::connection('mongodb')->collection('FT106')->get()->toArray();
            // $resultdata = DemoMongo::where('sysv', '=', '24.16')->first();

            //     $resultdata = 
            //     DemoMongo::where('sysv', '24.16')
            // ->take(10)
            // ->get();

            // $resultdata = DB::connection('mongodb')->collection('FT106')->where('sysv','24.16')->get()->toArray();
            // $resultdata = DB::connection('mongodb')->collection('FT106')->take(1);
            // $resultdata = DB::connection('mongodb')->collection('FT104/')->select($fieldName)->get();
            // $resultdata = DB::connection('mongodb')->collection('FT104/')->select('PRS_PV')->where('PRS_PV','LIKE','%'.$searchValue.'%')->get();

            // print_r(new DateTime('-1 day'));
            // $start = new DateTime('-9 day');
            // $stop = new DateTime('-0 day');
            // $resultdata = DemoMongo::where('dtm', '>=', new DateTime('-1 day'))->get();;
            // $resultdata = DemoMongo::whereBetween('dtm', array($start, $stop))->get();
            // $resultdata = DB::collection('860987054429532')->whereBetween('updated_at', array($start, $stop))->get();
            // echo "dddddddddddd";exit;

            // echo (new DateTime('17 Oct 2008'))->format('c');
            // $date =  date_format(new DateTime('12 May 2022'), 'c');
            // echo $date. " === ";
            $dt = Carbon::now()->startOfDay();

            $collection = DemoMongo::all();
            // $filtered = $collection->where('dtm', '2022-05-13T00:00:00.000Z');
            $filtered = $collection->where('a1', '>', "4.5");
            $resultdata =  $filtered->toArray();

            // $start = new MongoDate(strtotime("2022-05-10 00:00:00"));
            // $stop = new MongoDate(strtotime("2022-05-13 00:00:00"));

            // $resultdata = DemoMongo::whereBetween('created_at', array($start, $stop))->get();

            // // print_r(new DateTime('-1 day'));
            // $start = new DateTime('-9 day');
            // $stop = new DateTime('-0 day');
            // $resultdata = DemoMongo::where('dtm', '>=', new DateTime('-1 day'))->get();;
            // $resultdata = DemoMongo::whereBetween('dtm', array($start, $stop))->get();
            // $resultdata = DB::collection('860987054429532')->whereBetween('updated_at', array($start, $stop))->get();
            // echo "dddddddddddd";exit;
            // print_r($resultdata);


        } catch (\Exception $e) {
            echo "Mongo db connectin failed";
            exit;
            // dd($e->getMessage());
        }
        $start = date('Y-m-d', strtotime(date('Y-m-d') . ' - 30 day'));
        // $start = date('Y-m-d', strtotime(date('Y-m-d'). ' - 7 day'));
        $end = date('Y-m-d');
        // $end = date('Y-m-d', strtotime(date('Y-m-d'). ' + 7 day'));

        // echo  " $end end";
        // exit;
        // $res =  DataLog::select('Temperature_PV', 'Timestamp',
        // DB::raw('GROUP_CONCAT(DISTINCT  Temperature_PV SEPARATOR ",") AS Temperature_PV'),
        // DB::raw('GROUP_CONCAT(DISTINCT  Timestamp SEPARATOR ",") AS Timestamps'),
        // )
        // ->where("modem_id", 'FT104/')
        //     ->whereBetween('Timestamp', array($start, $end))
        //     // ->take(10000)
        //     ->groupBy('modem_id')
        //     ->first();
        // ->get()->toArray();

        $result =  DataLog::select('Temperature_PV', 'Timestamp',
        DB::raw('GROUP_CONCAT(DISTINCT  Temperature_PV SEPARATOR ",") AS Temperature_PV'),
        DB::raw('GROUP_CONCAT(DISTINCT  Timestamp SEPARATOR ",") AS Timestamps'),
        )
        ->where("modem_id", 'FT104/')
            ->whereBetween('Timestamp', array($start, $end))
            // ->take(10000)
            ->groupBy('modem_id')
            ->first();


        $result =  DataLog::where("modem_id", 'FT104/')->orderBy('Timestamp','desc')->first();


        // print_r($result);
        // exit;
        // $result = [];
        // $tempArray = [];
        // $dateArray = [];
        // foreach($res as $key => $val){
        //     $tempArray[$key] = $val['Temperature_PV'];
        //     $dateArray[$key] = $val['Timestamp'];
        // }
        // $result['temp'] = $tempArray; 
        // $result['date'] = $dateArray; 
        // print_r($result);
        // // // echo "dsd";
        // exit;

        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        $data['result']                    = $result;
        // $data['funinit']               = [''];
        $data['funinit']               = ['Dashboard.initMeter()'];
        return view('admin.meter.meter-dashboard', $data);
    }


    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        // echo "Fsdf -> ". $action;exit;
        switch ($action) {
            case 'getChartData':
                $this->_getChartData();
                break;
        }
        exit;
    }


    public function _getChartData()
    {
        //         // $collected_items = Device::whereNotNull('latitude')
        //         // ->whereNotNull('longitude')->get()->toArray();
        //         // $locationList = [];
        //         // foreach ($collected_items as $key => $values) {
        //         //     // print_r($values['location']);
        //         //     // exit;
        //         //     $url = url('/admin/device/device-detail/' .$values['id'] );
        //         //     $tempArray = array("Modem Id : " . $values['modem_id'] ." <br /> Project Name : ".  $values['project_name']." <br /> Region : ".  $values['region'] ." <br /> Location : ". $values['location']." <br />  <a href='".$url."'>".'View details' .'</a>', $values['latitude'], $values['longitude'], $values['id']);
        //         //     $locationList[$key] = $tempArray;
        //         // }
        //         // $locationList = DB::connection('mongodb')->collection('FT106')->get();
        //         // print_r($locationList);
        //         // exit;
        //         // $locationList = DB::connection('mongodb')->collection('FT104/')->take(10);
                $start = date('Y-m-d', strtotime(date('Y-m-d') . '-2 day'));
                $end = date('Y-m-d');

        //         $res =  DataLog::select(
        //             'Temperature_PV', 'Timestamp',
        //             // 'Temperature_PV', 'Timestamp',
        //         // DB::raw('GROUP_CONCAT(DISTINCT Temperature_PV SEPARATOR ",") AS Temperature_PV'),
        //         // DB::raw('GROUP_CONCAT(DISTINCT Timestamp SEPARATOR ",") AS Timestamps'),
        //         )
        //         ->where("modem_id", 'FT104/')
        //             ->whereBetween('Timestamp', array($start, $end))
        //             // ->take(10000)
        //             // ->groupBy('modem_id')
        //             ->get()->toArray();
        // // print_r($res);
        // // exit;

        $res =  DataLog::select(
            'Temperature_PV',
            'Timestamp',
            // 'Temperature_PV', 'Timestamp',
            // DB::raw('GROUP_CONCAT(DISTINCT Temperature_PV SEPARATOR ",") AS Temperature_PV'),
            // DB::raw('GROUP_CONCAT(DISTINCT Timestamp SEPARATOR ",") AS Timestamps'),
        )
            ->where("modem_id", 'FT104/')
            ->whereBetween('Timestamp', array($start, $end))
            ->take(10)
            ->get()->toArray();

        // print_r($res);
        $result = [];
        $tempArray = [];
        $dateArray = [];
        foreach ($res as $key => $val) {
            $tempArray[$key] = $val['Temperature_PV'];
            $dateArray[$key] = date('Y-m-d',strtotime($val['Timestamp']));
        }
        $result['temp'] = $tempArray;
        $result['date'] = $dateArray;
        // print_r($result);
        echo json_encode($result);
        exit;
    }
}
