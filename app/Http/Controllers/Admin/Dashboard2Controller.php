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
use App\Models\Honeywell;
use App\Models\DataLog;
use DateTime;

class Dashboard2Controller extends Controller
{

    protected $deviceName = '';
    public function __construct(Request $request)
    {
        $this->deviceName = ($request->route('modemId') ?  $request->route('modemId') :  '');
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
        // $data['result'] =  Honeywell::orderBy('dtm', 'desc')->first();
        // print_r($data['result']);
        // exit;
        // echo $result->obit1 . " === ";
        // //  var_dump((boolean)1);
        // print_r((boolean)($result->obit1&2));
        // // echo filter_var($pvasdsa1->obit1, FILTER_VALIDATE_BOOLEAN);
        // exit;

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

            $pv1 =  Honeywell::select('pv1 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $sp1 =  Honeywell::select('sp1 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $pv2 =  Honeywell::select('pv2 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $sp2 =  Honeywell::select('sp2 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $pv3 =  Honeywell::select('pv3 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $sp3 =  Honeywell::select('sp3 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $pv4 =  Honeywell::select('pv4 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $sp4 =  Honeywell::select('sp4 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $pv5 =  Honeywell::select('pv5 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $sp5 =  Honeywell::select('sp5 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $pv6 =  Honeywell::select('pv6 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

            $sp6 =  Honeywell::select('sp6 as value', DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'))
                ->where("modem_id", $this->deviceName)
                ->whereRaw("(dtm >= ? AND dtm <= ?)", [$start, $end])
                ->orderBy('dtm', 'desc')->get()->toArray();

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

            $array = [];
            $array[0] = $pv1;
            $array[1] = $sp1;
            $array[2] = $pv2;
            $array[3] = $sp2;
            $array[4] = $pv3;
            $array[5] = $sp3;
            $array[6] = $pv4;
            $array[7] = $sp4;
            $array[8] = $pv5;
            $array[9] = $sp5;
            $array[10] = $pv6;
            $array[11] = $sp6;
            // $array[3] = $convetArray;
            echo json_encode(array_reverse($array));
            exit;
        } catch (Exception $e) {
            $result['type'] = 'error';
            $result['message'] = $e->getMessage();
            echo json_encode($result);
            exit;
        }
    }
}
