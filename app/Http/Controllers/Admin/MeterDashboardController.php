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
// use DateTime;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

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


        $start = date('Y-m-d h:i:s', strtotime(date('Y-m-d  h:i:s') . '-24 hours'));
        $end = date('Y-m-d h:i:s');
        $start = date('Y-m-d');
        $end = date('Y-m-d');

        $res =  DataLog::select(
            'Temperature_PV',
            'Timestamp',
        )
            ->where("modem_id", 'FT104/')
            // ->whereBetween('Timestamp', array($start, $end))
            ->where('Timestamp', '>=', $start)
            ->where('Timestamp', '<=', $end)
            ->get()->toArray();



        // $fromDate = "2016-10-01";
        // $toDate   = "2016-10-31";

        // $reservations = DataLog::whereRaw(
        //     "(Timestamp >= ? AND Timestamp <= ?)",
        //     [$start . " 00:00:00", $end . " 23:59:59"]
        // )->where("modem_id", 'FT104/')->get()->toArray();
        // print_r($reservations);
        // exit;
        $result =  DataLog::where("modem_id", 'FT104/')->orderBy('Timestamp', 'desc')->first();

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
                $this->_getChartData($request->input('startDate'), $request->input('endDate'));
                break;
            case 'getChartDataV2':
                $this->_getChartDataV2($request->all());
                break;
        }
        exit;
    }


    public function _getChartData($start)
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
            'Timestamp',
            // DB::raw('DATE_FORMAT(Timestamp, "%Y-%m-%d") as formatted_Timestamp')
            // 'Temperature_PV', 'Timestamp',
            // DB::raw('GROUP_CONCAT(DISTINCT Temperature_PV SEPARATOR ",") AS Temperature_PV'),
            // DB::raw('GROUP_CONCAT(DISTINCT Timestamp SEPARATOR ",") AS Timestamps'),
        )
            ->where("modem_id", 'FT104/')
            ->whereRaw(
                "(Timestamp >= ? AND Timestamp <= ?)",
                [$start . " 00:00:00", $end . " 23:59:59"]
            )
            ->orderBy('Timestamp','desc')
            // ->whereBetween('Timestamp', array($start, $end))
            // ->take(100)
            ->get()->toArray();

        // // print_r($res);
        // $result = [];
        // $tempArray = [];
        // $dateArray = [];
        // $commonArray = [];
        // foreach ($res as $key => $val) {
        //     // $tempArray[$key] = $val['Temperature_PV'];
        //     // $dateArray[$key] = date('Y-m-d',strtotime($val['Timestamp']));

        //     $tempArray['y'] = $val['Temperature_PV'];
        //     $dateArray['x'] = $val['Timestamp'];
        //     // $commonArray[$key]['x'] = (gmstrftime("%a %B %d %Y %X %Z"));
        //     $commonArray[$key]['x'] = $val['Timestamp'];
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
        if (empty($start) && empty($end)) {
            $start = date('Y-m-d')." 00:00:00";
            $end = date('Y-m-d'). " 23:59:59";
        } else {
            $start = date('Y-m-d', strtotime($data['start']));
            $end = date('Y-m-d', strtotime($data['end']));
            // $start = date('Y-m-d h:i:s', strtotime(trim($explodeArray[0])));
            // $end = date('Y-m-d h:i:s', strtotime(trim($explodeArray[1])));
        }

        $res =  DataLog::select(
            'Temperature_PV as value',
            'Timestamp as date',
        )
            ->where("modem_id", 'FT104/')
            ->whereRaw(
                "(Timestamp >= ? AND Timestamp <= ?)",
                [$start . " 00:00:00", $end . " 23:59:59"]
            )
            ->orderBy('Timestamp','desc')
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
