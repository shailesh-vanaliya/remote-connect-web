<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Exports\DataLogExport;
use Illuminate\View\View;
use App\Models\DeviceAliasmap;
use App\Models\DataLog;
use App\Models\Flowmeter;
use App\Models\Device;
use PhpMqtt\Client\Facades\MQTT;

use Maatwebsite\Excel\Facades\Excel;

class FlowmeterDashboardController extends Controller
{
    protected $deviceName = '';
    protected $deviceDetail = [];
    public function __construct(Request $request)
    {
        $deviceObject = new Device();
        $res =  $deviceObject->deviceDetail(base64_decode($request->route('modemId')));
        $this->deviceName = (!empty($res) ?  $res->modem_id :  '');
        $this->deviceDetail = (!empty($res) ?  $res :  '');
        $this->middleware('admin');
    }

    /**
     * @return Factory|View
     */
    public function index(Request $request)
    {
        // echo $this->deviceName;
        $result =  Flowmeter::where("modem_id", $this->deviceName)->orderBy('dtm', 'desc')->first();
        $data['flmNo'] =  Flowmeter::select('flm_no', 'flm_no')
            ->where("modem_id", $this->deviceName)
            ->pluck('flm_no', 'flm_no')
            ->toArray();

        $deviceObject = new Device();

        $data['device'] =  $deviceObject->deviceDetail($this->deviceDetail->id);
        $alias =  DeviceAliasmap::where("modem_id", $this->deviceName)->first();
        // print_r($alias);
        // exit;
        $data['dashboard_alias'] = (isset($alias->dashboard_alias) && !empty($alias->dashboard_alias)) ? json_decode($alias->dashboard_alias, TRUE) : "";
        $data['unit_alias'] = (isset($alias->unit_alias) && !empty($alias->unit_alias)) ? json_decode($alias->unit_alias, TRUE) : "";

        $data['parameter_alias'] = (isset($alias->parameter_alias) && !empty($alias->parameter_alias)) ? json_decode($alias->parameter_alias, TRUE) : "";

        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/flowmeter.js'];
        $data['pluginjs']               = ['plugins/bootstrap-switch/js/bootstrap-switch.min.js'];
        $data['result']                    = $result;
        $data['funinit']               = ['Flowmeter.init()'];
        $data['header']    = [
            'title'      => 'Dashboard',
            'breadcrumb' => [
                'Home'     => '',
                'Dashboard' => '',
            ],
        ];
        return view('admin.dashboard.flowmeter', $data);
    }


    public function ajaxAction(Request $request)
    {

        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        // echo "Fsdf -> ". $action;exit;
        switch ($action) {
            case 'getFlowmeterData':
                $this->_getFlowmeterData($request->all());
                break;
            case 'getWeeklyChart':
                $this->_getWeeklyChart($request->all());
                break;
            case 'getMonthlyChart':
                $this->_getMonthlyChart($request->all());
                break;
        }
        exit;
    }


    public function _getFlowmeterData($data)
    {
        try {

            ini_set('memory_limit', -1);
            $start = $data['startDate'] . ":00";
            $end = $data['endDate'] . ":00";
            $this->deviceName = isset($data['modem_id'])  ? $data['modem_id'] : 'FT104';
            if (empty($start) && empty($end)) {
                $start = date('Y-m-d h:i:s');
                $end = date('Y-m-d h:i:s');
            }
            $queryBuilder  =    Flowmeter::select(
                'D0 as D0',
                DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'),
                // DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'),
            );
            $queryBuilder->where("modem_id", $this->deviceName);

            $queryBuilder->whereRaw(
                "(dtm >= ? AND dtm <= ?)",
                [$start, $end]
            );
            if (!empty($data['flm_no'])) {
                $queryBuilder->where("flm_no", $data['flm_no']);
            }
            $queryBuilder->orderBy('dtm', 'asc');
            $res =   $queryBuilder->get()->toArray();
            $alias =  DeviceAliasmap::where("modem_id", $this->deviceName)->first();
            $output['unit_alias'] = (isset($alias->unit_alias) && !empty($alias->unit_alias)) ? json_decode($alias->unit_alias, TRUE) : "";
            $output['chart_alias'] = (isset($alias->chart_alias) && !empty($alias->chart_alias)) ? json_decode($alias->chart_alias, TRUE) : "";
            $output['chart'] = $res;
            echo json_encode(array_reverse($output));
            exit;
        } catch (Exception $e) {
            $result['type'] = 'error';
            $result['message'] = $e->getMessage();
            echo json_encode($result);
            exit;
        }
    }



    public function meterDashboardExport(Request $request)
    {
        try {
            return Excel::download(new DataLogExport($request->all()), 'DataLogExport-' . date('Ymdhis') . '-.csv');
            // return response()->stream($callback, 200, $headers);
        } catch (Exception $e) {
            return redirect('admin/meter-dashboard')->with('session_error', 'DataLogExport Exports failed');
        }
    }


    public function _getWeeklyChart($data)
    {

        try {
            $today = date('Y-m-d');

            // echo date('d-m-Y', strtotime('last day of this month'));
            // echo " === \n ";
            // echo date('d-m-Y', strtotime('first day of this month'));
            // echo " === \n";
            // $week_start = date("Y-m-d", strtotime('monday this week')) ;   
            // $week_end = date("Y-m-d", strtotime('sunday this week')) ;

            $day = date('w');
            $week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
            $week_end = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));
            // echo $week_start . " === " . $week_end;
            $result = [];
            // $weekDateList = $this->displayDates($week_start, $week_end);
            $weekDateList = $this->displayDates('2022-05-15', '2022-05-25');
            foreach ($weekDateList as $key => $val) {
                $queryResFirst =  DataLog::select('TOTAL_FLOW', 'dtm', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                    // ->where("modem_id", $this->deviceName)
                    ->where("dtm", 'LIKE', "%$val%")
                    ->orderBy('dtm', 'asc')
                    ->first()->toArray();
                $queryReslast =  DataLog::select('TOTAL_FLOW', 'dtm', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                    // ->where("modem_id", $this->deviceName)
                    ->where("dtm", 'LIKE', "%$val%")
                    ->orderBy('dtm', 'desc')
                    ->first()->toArray();
                $amount = number_format($queryResFirst['TOTAL_FLOW'] - $queryReslast['TOTAL_FLOW'], 2);
                $result[$key]['date'] = $queryResFirst['date'];
                $result[$key]['value'] = floor($amount);
                // $result[$key]['value'] = number_format($queryResFirst['TOTAL_FLOW'] - $queryReslast['TOTAL_FLOW'], 2);
            }

            $res['chart'] = array_reverse($result);
            echo json_encode($res);
            //print_r(json_encode(array_reverse($array)));
            exit;
        } catch (Exception $e) {
            $result['type'] = 'error';
            $result['message'] = $e->getMessage();
            echo json_encode($result);
            exit;
        }
    }


    public function _getMonthlyChart($data)
    {

        try {
            $today = date('Y-m-d');
            $result = [];
            for ($i = 0; $i < 12; $i++) {
                $incrementVal = "";
                // echo 'First Date    = ' . date("Y-0$i-01") . '<br />';
                // echo 'Last Date     = ' . date("Y-$i-t")  . '<br />';
                $incrementVal = $i;
                $incrementVal++;
               
                $dts = ($incrementVal > 9) ? $incrementVal : '0'. $incrementVal;
                $first_date = date("Y-$dts",);
                // echo $first_date . " == " . '<br />';
       
                $queryResFirst =  DataLog::select('TOTAL_FLOW', 'dtm', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                    // ->where("modem_id", $this->deviceName)
                    ->where("dtm", 'LIKE', "%$first_date%")
                    ->orderBy('dtm', 'asc')
                    ->first();
                if(!empty($queryResFirst)){
                    $queryResFirst->toArray();
                    $queryReslast =  DataLog::select('TOTAL_FLOW', 'dtm', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                    // ->where("modem_id", $this->deviceName)
                    ->where("dtm", 'LIKE', "%$first_date%")
                    ->orderBy('dtm', 'desc')
                    ->first()->toArray();
                    $amount = number_format($queryResFirst['TOTAL_FLOW'] - $queryReslast['TOTAL_FLOW'], 2);
                    $result[$i]['monthName'] = date("F", strtotime($queryResFirst['dtm']));
                    $result[$i]['value'] = floor($amount);
                }else{
                    $result[$i]['monthName'] = date("F", strtotime($first_date));
                    $result[$i]['value'] = 0;
                }
            }
         
            $res['chart'] = array_reverse($result);
            echo json_encode($res);
            exit;
        } catch (Exception $e) {
            $result['type'] = 'error';
            $result['message'] = $e->getMessage();
            echo json_encode($result);
            exit;
        }
    }


    function displayDates($date1, $date2, $format = 'Y-m-d')
    {
        $dates = array();
        $current = strtotime($date1);
        $date2 = strtotime($date2);
        $stepVal = '+1 day';
        while ($current <= $date2) {
            $dates[] = date($format, $current);
            $current = strtotime($stepVal, $current);
        }
        return $dates;
    }
}
