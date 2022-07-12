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
use App\Models\Device;
use App\Models\Report;
use App\Models\AlertConfigration;

// use \PhpMqtt\Client\MqttClient;
// use \PhpMqtt\Client\ConnectionSettings;
// use PhpMqtt\Client\Facades\MQTT;
// use App\Http\Controllers\Admin\phpMQTT;
// require('./phpMQTT.php');
// require_once(app_path() . '/Http/Controllers/Admin/phpMQTT.php');
use PhpMqtt\Client\Facades\MQTT;

class AdminController extends Controller
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

        $reportObj = new Report();
        $data['reportCount'] = $reportObj->getReportsData('count');

        $deviceObj = new Device();
        $device = $deviceObj->getDeviceByUser();
        $data['device'] =  $device->count();

        $data['client']                = User::where("role", 'USER')->count();
        $data['pagetitle']             = 'Dashboard';
        $data['js']                    = ['admin/dashboard.js'];
        $data['funinit']               = ['Dashboard.init()'];
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $data['alertCount'] = AlertConfigration::count();
        } else {
            $data['alertCount'] = AlertConfigration::where('created_by', Auth::guard('admin')->user()->id)->count();
        }

        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $onlineDevice =  Device::select(
                'device_map.MQTT_ID',
                'device_map.max_user_access',
                'device_map.IMEI_No',
                'device_status.Status',
                'remote.MACHINE_NO',
                'remote.MACHINE_LOCAL_IP',
                'remote.MACHINE_LOCAL_PORT',
                'remote.MACHINE_REMOTE_PORT',
                'device_map.subscription_status',
                'device_type.device_type',
                'devices.*',
            );
            $onlineDevice->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $onlineDevice->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $onlineDevice->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $onlineDevice->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $onlineDevice->where('device_status.Status', 1);
            $onlineDevice->groupBy('devices.id');
            $data['onlineDevice'] =  $onlineDevice->get()->toArray();
            $data['onlineDevice'] = count($data['onlineDevice']);
        } else {
            $onlineDevice =  Device::select(
                'device_map.MQTT_ID',
                'device_map.max_user_access',
                'device_map.subscription_status',
                'device_map.IMEI_No',
                'device_status.Status',
                'device_type.device_type',
                'devices.*',
            );
            if (Auth::guard('admin')->user()->role == "ADMIN") {
                $onlineDevice->where('devices.organization_id', Auth::guard('admin')->user()->organization_id);
            } else {
                $onlineDevice->where('devices.created_by', Auth::guard('admin')->user()->id);
            }
            // $onlineDevice->where('devices.created_by', Auth::guard('admin')->user()->id);
            $onlineDevice->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $onlineDevice->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $onlineDevice->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $onlineDevice->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $onlineDevice->where('device_status.Status', 1);
            $onlineDevice->groupBy('devices.id');
            $data['onlineDevice'] =  $onlineDevice->get()->toArray();
            $data['onlineDevice'] = count($data['onlineDevice']);
        }
        $data['header']    = [
            'title'      => 'Dashboard',
            'breadcrumb' => [
                'Dashboard'     => '',
                'View' => '',
            ],
        ];
        $query = User::select(
            'users.*',
            DB::raw("SUM(users.report_schedule_quota) as report_schedule_quota"),
            DB::raw("SUM(users.storage_usage) as storage_usage"),
            DB::raw("SUM(users.storage_quota) as storage_quota"),
            DB::raw("SUM(users.report_counter) as report_counter"),
            DB::raw("SUM(users.report_quota) as report_quota"),
            DB::raw("SUM(users.sms_counter) as sms_counter"),
            DB::raw("SUM(users.sms_quota) as sms_quota"),
            DB::raw("SUM(users.email_counter) as email_counter"),
            DB::raw("SUM(users.email_quota) as email_quota"),
            DB::raw("SUM(users.notification_quota) as notification_quota"),
            DB::raw("SUM(users.notification_counter) as notification_counter"),
        );
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $query->where('users.role', User::ROLES['ADMIN']);
            $query->orWhere('users.role', User::ROLES['USER']);
            $query->orWhere('users.role', User::ROLES['ENG']);
            $query->latest('created_at');
        }
        if (Auth::guard('admin')->user()->role == 'ORGANIZATION') {
            $query->orWhere('users.role', User::ROLES['USER']);
            $query->where('organization_id', Auth::guard('admin')->user()->organization_id);
        }
        if (Auth::guard('admin')->user()->role == 'USER') {
            $query->where('organization_id', Auth::guard('admin')->user()->id);
        }
        $data['users'] = $query->first();

        return view('admin.dashboard', $data);
    }
}
