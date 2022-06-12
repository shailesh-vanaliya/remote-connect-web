<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Models\AlertConfigration;
use App\Models\ReportConfiguration;
use App\Models\Notification;
use Hash;
use App\Models\User;
use Config;
use DateTime;
use finfo;
use Illuminate\Support\Facades\Date;
use Session;
use Illuminate\Support\Carbon;
use PDF;
use App;
use DB;
// use App\Models\Booking;


class CronController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
    }

    public function addsignee(Request $request)
    {
        echo "Fsdsd";
    }


    function alertCron()
    {
        echo "dddddd";
        echo "<pre/>";

        \Log::info(" Run Status Inactive cronjob ");
        // $alertObj = AlertConfigration::select('*')
        // // ->where('status', 'Active')->where('role', 'SIGNEE')
        // ->get()->toArray();
        // print_r($alertObj);
        // exit;



        $subQuery = ReportConfiguration::select(
            'report_configurations.report_title',
            'report_configurations.parameter',
            'devices.modem_id',
            'organizations.organization_name',
            'device_type.device_type',
            'device_type.data_source',
            'device_type.data_table',
            'device_type.dashboard_id',
            'report_schedules.start_time',
            'report_schedules.end_time',
            'report_schedules.execution_time',
            'report_schedules.repeat_on',
            'report_schedules.sender_user_list',
        );
        $subQuery->Join('devices',  'devices.id', '=', 'report_configurations.device_id');
        $subQuery->Join('report_schedules',  'report_schedules.report_config_id', '=', 'report_configurations.id');
        $subQuery->Join('organizations',  'organizations.id', '=', 'report_configurations.organization_id');

        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });

        $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
        $result = $subQuery->latest('report_configurations.created_at')->get()->toArray();
        print_r($result);
        exit;

        // foreach ($userObj as $key => $value) {
        //     if ($value['last_login_date'] != '' && $value['last_login_date'] != null) {
        //         $date1 = new DateTime(date('Y-m-d H:i:s'));
        //         $date2 = new DateTime($value['last_login_date']);
        //         $interval = $date1->diff($date2);
        //         if ($interval->y > 0) {
        //             $userUpdateObj = User::find($value['id']);
        //             $userUpdateObj->status = 'Dormant';
        //             $userUpdateObj->save();
        //         } else if ($interval->m > 5) {
        //             $userUpdateObj = User::find($value['id']);
        //             $userUpdateObj->status = 'Inactive';
        //             $userUpdateObj->save();
        //         }
        //     }
        // }
    }
}
