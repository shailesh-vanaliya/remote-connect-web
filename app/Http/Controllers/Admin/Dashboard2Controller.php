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

    public function __construct()
    {
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

        $start = $data['startDate'] . ":00";
        $end = $data['endDate'] . ":00";
        $this->deviceName = isset($data['modem_id'])  ? $data['modem_id'] : 'FT104';
        if (empty($start) && empty($end)) {
            $start = date('Y-m-d h:i:s');
            $end = date('Y-m-d h:i:s');
        } else {
            // $start = date('Y-m-d h:i:s', strtotime($start));
            // $end = date('Y-m-d h:i:s', strtotime($end));
        }
       
        $pv1 =  Honeywell::select(
            'pv1 as value',
            // DB::raw('UNIX_TIMESTAMP(dtm) as date'),
            'dtm as date',
        )
            ->where("modem_id", 'FT112')
            ->whereRaw("(dtm >= ? AND dtm <= ?)",[$start, $end])
            ->orderBy('dtm', 'desc')
            // ->take(100)
            ->get()
            ->toArray();

        $sp1 =  Honeywell::select('sp1 as value','dtm as date')
            ->where("modem_id", 'FT112')
            ->whereRaw("(dtm >= ? AND dtm <= ?)",[$start, $end])
            ->orderBy('dtm', 'desc')
            // ->take(100)
            ->get()->toArray();

        $out1 =  Honeywell::select('out1 as value', 'dtm as date',)
            ->where("modem_id", 'FT112')->orderBy('dtm', 'desc')
            ->whereRaw("(dtm >= ? AND dtm <= ?)",[$start, $end])
            // ->take(100)
            ->get()->toArray();
        // print_r($out1);
        // exit;
        $obit1 =  Honeywell::select('obit1 as value', 'dtm as date',)
            ->where("modem_id", 'FT112')->orderBy('dtm', 'desc')
            ->whereRaw("(dtm >= ? AND dtm <= ?)",[$start, $end])
            // ->take(100)
            ->get()->toArray();
        // print_r($obit1[0]['value']);
        // exit;
        // $array = array($pv1,$sp1);
        $array = [];
        $array[0] = $pv1;
        $array[1] = $sp1;
        $array[2] = $out1;
        $array[3]= $obit1;
        // print_r($array);
        // exit;
        echo json_encode(array_reverse($array));
        exit;
    }
}
