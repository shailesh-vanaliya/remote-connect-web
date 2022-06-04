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
use PhpMqtt\Client\Facades\MQTT;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MeterDashboardController extends Controller
{
    protected $deviceName = '';
    public function __construct(Request $request)
    {
        $this->deviceName = ($request->route('modemId') ?  $request->route('modemId') :  'FT104');
        $this->middleware('admin');
    }

    /**
     * @return Factory|View
     */
    public function index(Request $request)
    {;
        $result =  DataLog::where("modem_id", $this->deviceName)->orderBy('dtm', 'desc')->first();

        $deviceObject = new Device();
        $data['device'] =  $deviceObject->deviceDetailByModel($this->deviceName);
        // $data['device'] =  Device::where("modem_id", $this->deviceName)->first();
        // print_r($date['device']);
        // exit;

        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        $data['pluginjs']               = ['plugins/bootstrap-switch/js/bootstrap-switch.min.js'];
        $data['result']                    = $result;
        $data['funinit']               = ['Dashboard.initMeter()'];
        $data['header']    = [
            'title'      => 'Dashboard',
            'breadcrumb' => [
                'Home'     => '',
                'Dashboard' => '',
            ],
        ];
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
            case 'sendMachine':
                $this->_sendMachine($request->all());
                break;
            case 'sendMoisture':
                $this->_sendMoisture($request->all());
                break;
        }
        exit;
    }

    public function _sendMoisture($requestData)
    {
        try {

            $deviceObject = new Device();
            $details =  $deviceObject->deviceDetail($requestData['deviceId']);

            $data = array(
                'data' => intval($requestData['value']),
                'client id' => (isset($details->modem_id) ?  $details->modem_id : ''),
            );
            // SW1(Topic:FT107/SUB_MOIS_START)
            // {"data":#VALUE,"client id":"FT104_client3"}
            $res = MQTT::publish($details->modem_id . "/1/SUB_MOIS_START", json_encode($data));
            $result['status'] = 'success';
            $result['message'] = 'Status updated successfully';
        } catch (\Exception $e) {
            $result['status'] = 'error';
            $result['message'] = 'Something went wrong';
        }
        echo json_encode($result);
        exit;
    }

    public function _sendMachine($requestData)
    {
        try {

            $deviceObject = new Device();
            $details =  $deviceObject->deviceDetail($requestData['deviceId']);

            $data = array(
                'data' => intval($requestData['value']),
                'client id' => (isset($details->modem_id) ?  $details->modem_id : ''),
            );
            // SW1(Topic:FT107/SUB_MOIS_START)
            // {"data":#VALUE,"client id":"FT104_client3"}
            $res = MQTT::publish($details->modem_id . "/1/SUB_MACH_START", json_encode($data));
            $result['status'] = 'success';
            $result['message'] = 'Status updated successfully';
        } catch (\Exception $e) {
            $result['status'] = 'error';
            $result['message'] = 'Something went wrong';
        }
        echo json_encode($result);
        exit;
    }

    public function _getChartData($start, $end)
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
            // 'dtm',
            DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as dtm'),
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
            ->orderBy('dtm', 'desc')
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
        echo json_encode(array_reverse($res));
        exit;
    }
    public function _getChartDataV2($data)
    {
        try {
            // $explodeArray = explode(' - ',$data['dateRange']);
            // $start = $explodeArray[0];
            // $endA = $explodeArray[1];
            // echo $endA . " ===  ";
            // // exit;
            // $start = date('Y-m-d h:i:s', strtotime($start));
            //     $end = date('Y-m-d h:i:s', strtotime($endA));
            // echo $start . " === " . $end;
            // exit;
            ini_set('max_execution_time', 120000);
            $start = $data['startDate'] . ":00";
            $end = $data['endDate'] . ":00";
            $this->deviceName = isset($data['modem_id'])  ? $data['modem_id'] : 'FT104';
            if (empty($start) && empty($end)) {
                // $start = date('Y-m-d') . " 00:00:00";
                // $end = date('Y-m-d') . " 23:59:59";
                $start = date('Y-m-d h:i:s');
                $end = date('Y-m-d h:i:s');
            } else {
                // $start = date('Y-m-d h:i:s', strtotime($start));
                // $end = date('Y-m-d h:i:s', strtotime($end));
            }
            $res =  DataLog::select(
                'Temperature_PV as value',
                // 'dtm as date',
                DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'),
            )
                ->where("modem_id", 'FT104')
                ->whereRaw(
                    "(dtm >= ? AND dtm <= ?)",
                    [$start, $end]
                    // [$start . " 00:00:00", $end . " 23:59:59"]
                )
                ->orderBy('dtm', 'desc')
                ->get()->toArray();

            echo json_encode(array_reverse($res));
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
}
