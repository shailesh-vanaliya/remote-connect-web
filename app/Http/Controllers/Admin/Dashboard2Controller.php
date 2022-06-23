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
use App\Models\PIDAllData;
use App\Models\Device;
use App\Models\Honeywell;
use App\Models\DeviceAliasmap;
use App\Models\DataLog;
use DateTime;
use PhpMqtt\Client\Facades\MQTT;

class Dashboard2Controller extends Controller
{

    protected $deviceName = '';
    protected $deviceDetail = [];
    public function __construct(Request $request)
    {
        // $this->deviceName = ($request->route('modemId') ?  $request->route('modemId') :  '');
        $deviceObject = new Device();
        $res =  $deviceObject->deviceDetail(base64_decode($request->route('modemId')));

        $this->deviceName = (!empty($res) ?  $res->modem_id :  '');
        $this->deviceDetail = (!empty($res) ?  $res :  '');
        $this->middleware('admin');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboardV2.js'];
        $data['funinit']               = ['DashboardV2.init()'];

        // $data['result'] =  Honeywell::where("id", '4456')->orderBy('dtm', 'desc')->first();
        // print_r($data['result']);
        // exit;  
        $data['result'] =  Honeywell::where("modem_id", $this->deviceName)->orderBy('dtm', 'desc')->first();
        $data['PIDAllData'] =  PIDAllData::where("modem_id", $this->deviceName)->orderBy('dtm', 'desc')->first();
        $data['jsonDecode']= (isset($data['PIDAllData']['data']) && !empty($data['PIDAllData']['data'])) ? json_decode($data['PIDAllData']['data'],TRUE) : "";
        
        $alias =  DeviceAliasmap::where("modem_id", $this->deviceName)->first();
        $data['dashboard_alias']= (isset($alias->dashboard_alias) && !empty($alias->dashboard_alias)) ? json_decode($alias->dashboard_alias,TRUE) : "";
        $data['parameter_alias']= (isset($alias->parameter_alias) && !empty($alias->parameter_alias)) ? json_decode($alias->parameter_alias,TRUE) : "";


// print_r($data['dashboard_alias']);
// exit;
        
        // $jsonDecode = json_decode($jsonDecode, TRUE);
        // $data['jsonDecode'] = json_decode('{"SV1": 500, "TM1": 1, "OUT1": 1000, "SV2": 1000, "TM2": 1, "OUT2": 1000, "SV3": 1000, "TM3": 65535, "OUT3": 1000, "SV4": 0, "TM4": 0, "OUT4": 0, "SV5": 0, "TM5": 0, "OUT5": 0, "SV6": 0, "TM6": 0, "OUT6": 0, "SV7": 0, "TM7": 0, "OUT7": 0, "SV8": 0, "TM8": 0, "OUT8": 0}', TRUE);
        // print_r($data['jsonDecode']);
        // exit;
        // foreach($data['jsonDecode'] as $key => $val){
        //     print_r($key);
        //     print_r($val);
        // }
        // exit;
        $data['deviceName'] = $this->deviceName;
        return view('admin.dashboard.dashboard2', $data);
    }


    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        // echo "Fsdf -> ". $action;exit;
        switch ($action) {
            case 'getChartDataV2':
                $this->_getChartDataV2($request->all());
                break;
        }
        exit;
    }
    public function _getChartDataV2($data)
    {

        try {
            $start = $data['startDate'] . ":00";
            $end = $data['endDate'] . ":00";
            $this->deviceName = isset($data['modem_id'])  ? $data['modem_id'] : '';
            if (empty($start) && empty($end)) {
                $start = date('Y-m-d h:i:s');
                $end = date('Y-m-d h:i:s');
            } else {
                // $start = date('Y-m-d h:i:s', strtotime($start));
                // $end = date('Y-m-d h:i:s', strtotime($end));
            }

            $pv1 =  Honeywell::select('pv1 as 0','sp1 as 1','pv2 as 2','sp2 as 3','pv3 as 4','sp3 as 5','pv4 as 6','sp4 as 7','pv5 as 8','sp5 as 9','pv6 as 10','sp6 as 11', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'asc')->get()->toArray();

            // $sp1 =  Honeywell::select('sp1 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $pv2 =  Honeywell::select('pv2 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $sp2 =  Honeywell::select('sp2 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $pv3 =  Honeywell::select('pv3 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $sp3 =  Honeywell::select('sp3 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $pv4 =  Honeywell::select('pv4 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $sp4 =  Honeywell::select('sp4 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $pv5 =  Honeywell::select('pv5 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $sp5 =  Honeywell::select('sp5 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $pv6 =  Honeywell::select('pv6 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $sp6 =  Honeywell::select('sp6 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            //     ->where("modem_id", $this->deviceName)
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->orderBy('dtm', 'asc')->get()->toArray();

            // $out1 =  Honeywell::select('out1 as value',DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'),)
            //     ->where("modem_id", $this->deviceName)
            //     ->orderBy('dtm', 'desc')
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->get()->toArray();

            // $obit1 =  Honeywell::select('obit1 as value',DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
            // ->where("modem_id", $this->deviceName)
            //     ->orderBy('dtm', 'desc')
            //     ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
            //     ->get()->toArray();

            // $array = [];
           
            // $array[0] = $pv1;
            // $array[1] = $sp1;
            // $array[2] = $pv2;
            // $array[3] = $sp2;
            // $array[4] = $pv3;
            // $array[5] = $sp3;
            // $array[6] = $pv4;
            // $array[7] = $sp4;
            // $array[8] = $pv5;
            // $array[9] = $sp5;
            // $array[10] = $pv6;
            // $array[11] = $sp6;
            // $array[3] = $convetArray;

            $alias =  DeviceAliasmap::where("modem_id", $this->deviceName)->first();
            $chart_alias = isset($alias->chart_alias) ? array_values(json_decode($alias->chart_alias,TRUE)) : '';
        
            $res['chart_alias'] = $chart_alias;
            $res['chart'] = $pv1;
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


    public function updatePiddata(Request $request)
    {
        // print_r($request->all());
        $postData = $request->all();
        unset($postData['_token']);
        if ($postData['button'] == "Read") {
            unset($postData['button']);
            $result = [];
            try {
                foreach ($postData  as $key => $val) {
                    $result[$key] = $val;
                }
                $data = array(
                    "data" => 1,
                    "Modem id" => (isset($this->deviceName) ?  $this->deviceName : ''),
                    "client id" => (isset(Auth::guard('admin')->user()->id) ?  Auth::guard('admin')->user()->full_name : ''),
                );
                $res = MQTT::publish($this->deviceName . "/1/SUB_PTN1_READ", json_encode($data));
                return redirect('admin/dashboard2/' . $this->deviceName)->with('session_success', 'Data Read successfully please Refersh page');
            } catch (\Exception $e) {
                return redirect('admin/dashboard2/' . $this->deviceName)->with('session_error', 'Data Read failed');
            }
        } else {
            unset($postData['button']);
            $result = [];
            try {
                foreach ($postData  as $key => $val) {
                    $result[$key] = (int)$val;
                }
                // print_r($result);
                
                $data = array(
                    "data" => $result,
                    "Modem id" => (isset($this->deviceName) ?  $this->deviceName : ''),
                    "client id" => (isset(Auth::guard('admin')->user()->id) ?  Auth::guard('admin')->user()->full_name : ''),
                );
             
                $res = MQTT::publish($this->deviceName . "/1/SUB_PTN1_WR", json_encode($data));
                return redirect('admin/dashboard2/' . $this->deviceName)->with('session_success', 'Data write successfully read and recheck ');
            } catch (\Exception $e) {
                return redirect('admin/dashboard2/' . $this->deviceName)->with('session_error', 'Data write failed');
            }
        }
    }
}
