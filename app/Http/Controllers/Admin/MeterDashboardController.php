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
use App\Exports\DataLogExport;
use Illuminate\View\View;
use App\Models\DemoMongo;
use App\Models\DataLog;
use App\Models\Device;
// use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MeterDashboardController extends Controller
{
    protected $deviceName = '';
    public function __construct(Request $request)
    {
        $this->deviceName =( $request->route('id') ?  $request->route('id') :  'FT104/');
        $this->middleware('admin');
    }

    /**
     * @return Factory|View
     */
    public function index(Request $request)
    {
     
        $start = date('Y-m-d h:i:s', strtotime(date('Y-m-d  h:i:s') . '-24 hours'));
        $end = date('Y-m-d h:i:s');
        $start = date('Y-m-d');
        $end = date('Y-m-d');

        $res =  DataLog::select(
            'Temperature_PV',
            'dtm',
        )
            ->where("modem_id", $this->deviceName)
            // ->whereBetween('dtm', array($start, $end))
            ->where('dtm', '>=', $start)
            ->where('dtm', '<=', $end)
            ->get()->toArray();



        // $fromDate = "2016-10-01";
        // $toDate   = "2016-10-31";

        // $reservations = DataLog::whereRaw(
        //     "(dtm >= ? AND dtm <= ?)",
        //     [$start . " 00:00:00", $end . " 23:59:59"]
        // )->where("modem_id", 'FT104/')->get()->toArray();
        // print_r($reservations);
        // exit;
        $result =  DataLog::where("modem_id", $this->deviceName)->orderBy('dtm', 'desc')->first();

        // print_r($result);
        // exit;
        // $result = [];
        // $tempArray = [];
        // $dateArray = [];
        // foreach($res as $key => $val){
        //     $tempArray[$key] = $val['Temperature_PV'];
        //     $dateArray[$key] = $val['dtm'];
        // }
        // $result['temp'] = $tempArray; 
        // $result['date'] = $dateArray; 
        // print_r($result);
        // // // echo "dsd";
        // exit;
        $data['device'] =  Device::where("modem_id", $this->deviceName)->first();
        // print_r($date['device']);
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
                $this->_getChartData($request->input('startDate'), $request->input('endDate'));
                break;
            case 'getChartDataV2':
                $this->_getChartDataV2($request->all());
                break;
        }
        exit;
    }


    public function _getChartData($start,$end)
    {

        // $start = date('Y-m-d', strtotime(date('Y-m-d') . '-8 day'));
        // $end = date('Y-m-d');
        // $start = date('Y-m-d', strtotime(date('Y-m-d') . '-10 day'));
        // $end = date('Y-m-d');

        if (empty($start) && empty($end)) {
            $start = date('Y-m-d');
            $end = date('Y-m-d');
        } else {
            $start = date('Y-m-d', strtotime($start));
            $end = date('Y-m-d', strtotime($end));
        }
        // $start = date('Y-m-d', strtotime(date('Y-m-d') . '-10 day'));

        $res =  DataLog::select(
            'Temperature_PV',
            'dtm',
            // DB::raw('DATE_FORMAT(dtm, "%Y-%m-%d") as formatted_dtm')
            // 'Temperature_PV', 'dtm',
            // DB::raw('GROUP_CONCAT(DISTINCT Temperature_PV SEPARATOR ",") AS Temperature_PV'),
            // DB::raw('GROUP_CONCAT(DISTINCT dtm SEPARATOR ",") AS dtms'),
        )
            ->where("modem_id", $this->deviceName)
            ->whereRaw(
                "(dtm >= ? AND dtm <= ?)",
                [$start . " 00:00:00", $end . " 23:59:59"]
            )
            ->orderBy('dtm','desc')
            // ->whereBetween('dtm', array($start, $end))
            // ->take(100)
            ->get()->toArray();

        // // print_r($res);
        // $result = [];
        // $tempArray = [];
        // $dateArray = [];
        // $commonArray = [];
        // foreach ($res as $key => $val) {
        //     // $tempArray[$key] = $val['Temperature_PV'];
        //     // $dateArray[$key] = date('Y-m-d',strtotime($val['dtm']));

        //     $tempArray['y'] = $val['Temperature_PV'];
        //     $dateArray['x'] = $val['dtm'];
        //     // $commonArray[$key]['x'] = (gmstrftime("%a %B %d %Y %X %Z"));
        //     $commonArray[$key]['x'] = $val['dtm'];
        //     $commonArray[$key]['y'] = $val['Temperature_PV'];
        // }
        // $result['temp'] = $tempArray;
        // $result['date'] = $dateArray;
        // $result['common'] = $commonArray;
        // print_r($result);
        echo json_encode( array_reverse($res));
        exit;
    }
    public function _getChartDataV2($data)
    {
        // $explodeArray = explode(' - ',$data['dateRange']);
        // $start = $explodeArray[0];
        // $endA = $explodeArray[1];
        // echo $endA . " ===  ";
        // // exit;
        // $start = date('Y-m-d h:i:s', strtotime($start));
        //     $end = date('Y-m-d h:i:s', strtotime($endA));
        // echo $start . " === " . $end;
        // exit;
        $start = $data['startDate'];
        $end = $data['endDate'];
        if (empty($start) && empty($end)) {
            $start = date('Y-m-d')." 00:00:00";
            $end = date('Y-m-d'). " 23:59:59";
        } else {
            $start = date('Y-m-d', strtotime($start));
            $end = date('Y-m-d', strtotime($end));
            // $start = date('Y-m-d h:i:s', strtotime(trim($explodeArray[0])));
            // $end = date('Y-m-d h:i:s', strtotime(trim($explodeArray[1])));
        }

        $res =  DataLog::select(
            'Temperature_PV as value',
            'dtm as date',
        )
            ->where("modem_id", $this->deviceName)
            ->whereRaw(
                "(dtm >= ? AND dtm <= ?)",
                [$start . " 00:00:00", $end . " 23:59:59"]
            )
            ->orderBy('dtm','desc')
            ->get()->toArray();
        echo json_encode( array_reverse($res));
        exit;
    }

    public function meterDashboardExport(Request $request)
    {
        try {

            return Excel::download(new DataLogExport($request->all()), 'DataLogExport-'.date('Ymdhis').'-.csv');

            // return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            return redirect('admin/meter_dashboard')->with('session_error', 'DataLogExport Exports failed');
        }
    }
}
