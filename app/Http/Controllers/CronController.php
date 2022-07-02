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
use App\Models\DeviceAliasmap;
use App\Models\Device;


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

    public function deviceAlias(Request $request, $id)
    {
        
        $subQuery =  Device::select(
            'device_map.MQTT_ID',
            'device_map.max_user_access',
            'device_map.IMEI_No',
            'device_status.Status',
            'device_status.id as device_status_id',

            'remote.STATUS',
            'device_map.device_type_id',
            'device_type.device_type',
            'device_type.parameter_alias',
            'device_type.dashboard_alias',
            'device_type.chart_alias',
            'device_type.unit_alias',
            'device_type.data_table',
            'device_type.dashboard_id',
            'devices.*',
        );

        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });

        $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
        $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
        if(!empty($id)){
            $subQuery->where('devices.id', $id);
        }
        $subQuery->groupBy('devices.id');
        $retun =   $subQuery->get()->toArray();
 
        foreach ($retun as $key => $val) {
       
            $count = DeviceAliasmap::where(['modem_id' => $val['modem_id']])->count();
            // if ($count == 0) {
                $collegeDetails = DeviceAliasmap::firstOrNew(array('modem_id' => $val['modem_id']));
                $collegeDetails->dashboard_alias = $val['dashboard_alias'];
                $collegeDetails->parameter_alias = $val['parameter_alias'];
                $collegeDetails->chart_alias = $val['chart_alias'];
                $collegeDetails->unit_alias = $val['unit_alias'];
                $collegeDetails->updated_at = Carbon::now();
                $collegeDetails->created_at = Carbon::now();
                $collegeDetails->updated_by = 1;
                $collegeDetails->created_by = 1;
                $collegeDetails->save();
                // DeviceAliasmap::where(['modem_id' => $val['modem_id']])
                // // DeviceAliasmap::where(['modem_id' => $val['modem_id']])
                //     ->insert([
                //         'dashboard_alias' => $val['dashboard_alias'],
                //         'parameter_alias' => $val['parameter_alias'],
                //         'chart_alias' => $val['chart_alias'],
                //         'updated_at' => Carbon::now(),
                //         'created_at' => Carbon::now(),
                //         'modem_id' => $val['modem_id'],
                //         'updated_by' => 1,
                //         'created_by' => 1,
                //     ]);
            // }
        }
    }
}
