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
use App\Models\ColdStorage;
use App\Models\Device;
use PhpMqtt\Client\Facades\MQTT;

use Maatwebsite\Excel\Facades\Excel;

class ColdStorageDashboardController extends Controller
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
        $result =  ColdStorage::where("modem_id", $this->deviceName)->orderBy('dtm', 'desc')->first();

        $deviceObject = new Device();

        $data['device'] =  $deviceObject->deviceDetail($this->deviceDetail->id);
        $alias =  DeviceAliasmap::where("modem_id", $this->deviceName)->first();
        $data['dashboard_alias'] = (isset($alias->dashboard_alias) && !empty($alias->dashboard_alias)) ? json_decode($alias->dashboard_alias, TRUE) : "";

        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/coldStorageDashboard.js'];
        $data['pluginjs']               = ['plugins/bootstrap-switch/js/bootstrap-switch.min.js'];
        $data['result']                    = $result;
        $data['funinit']               = ['ColdStorageDashboard.init()'];
        $data['header']    = [
            'title'      => 'Dashboard',
            'breadcrumb' => [
                'Home'     => '',
                'Dashboard' => '',
            ],
        ];
        return view('admin.dashboard.cold-storage-dashboard', $data);
    }


    public function ajaxAction(Request $request)
    {
        $collegeId = Auth::guard('admin')->user()->id;
        $action = $request->input('action');
        // echo "Fsdf -> ". $action;exit;
        switch ($action) {
            case 'getColdChartData':
                $this->_getColdChartData($request->all());
                break;
        }
        exit;
    }


    public function _getColdChartData($data)
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
            $res =  ColdStorage::select(
                'temperature',
                'co2',
                'humidity',
                'dtm as date',
                // DB::raw('(UNIX_TIMESTAMP(dtm) * 1000) as date'),
            )
                // ->where("modem_id", $this->deviceName)
                // ->whereRaw(
                //     "(dtm >= ? AND dtm <= ?)",
                //     [$start, $end]
                // )
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
