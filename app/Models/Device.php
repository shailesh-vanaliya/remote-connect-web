<?php

namespace App\Models;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['modem_id', 'model_no','secret_key', 'project_name','data_table', 'customer_name', 'region', 'location', 'machine_type', 'latitude', 'longitude', 'description','created_by', 'updated_by'];

    

    public function deviceDetail($id)
    {
        $subQuery =  Device::select(
            'device_map.MQTT_ID',
            'device_map.max_user_access',
            'device_map.IMEI_No',
            'device_status.Status',
            'device_status.id as device_status_id',
            'remote.MACHINE_NO',
            'remote.MACHINE_LOCAL_IP',
            'remote.MACHINE_LOCAL_PORT',
            'remote.MACHINE_REMOTE_PORT',
            'remote.STATUS',
            'devices.*',
        );

        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
        });

        $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
        $subQuery->where('devices.id', '=', $id);
        $subQuery->groupBy('devices.id');
        return  $subQuery->first();
    }

    public function deviceDetailByModel($modem_id)
    {
        // $aaa = DeviceType::find(1);
        // print_r($aaa);
        // exit;
        $subQuery =  Device::select(
            'device_map.MQTT_ID',
            'device_map.max_user_access',
            'device_map.IMEI_No',
            'device_status.Status',
            'device_status.id as device_status_id',
            'remote.MACHINE_NO',
            'remote.MACHINE_LOCAL_IP',
            'remote.MACHINE_LOCAL_PORT',
            'remote.MACHINE_REMOTE_PORT',
            'remote.STATUS',
            'device_type.device_type',
            'devices.*',
        );

        $subQuery->Join('device_map', function ($join) {
            $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
            $join->on('device_map.secret_key', '=', 'devices.secret_key');
            // $join->on('device_map.device_type_id', '=', 'device_type.id');
        });

        $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
        $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
        $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
        $subQuery->where('devices.modem_id', '=', $modem_id);
        $subQuery->groupBy('devices.id');
        return  $subQuery->first();
    }


    public function getDeviceByUser(){
         
        $keyword = "";
        if (Auth::guard('admin')->user()->role == 'SUPERADMIN') {
            $subQuery =  Device::select(
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
                'device_type.data_table',
                'device_type.dashboard_id',
                'devices.*',
            );
            $subQuery->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $subQuery->leftJoin('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            if(!empty($keyword)){
                $subQuery->orWhere('devices.location', 'LIKE', "%$keyword%");
                $subQuery->orWhere('devices.updated_by', 'LIKE', "%$keyword%");
            }
            $subQuery->groupBy('devices.id');
            $device =  $subQuery->latest('devices.created_at')->get();
            return $device;
        } else {
            $subQuery =  Device::select(
                'device_map.MQTT_ID',
                'device_map.max_user_access',
                'device_map.subscription_status',
                'device_map.IMEI_No',
                'device_status.Status',
                'device_type.device_type',
                'device_type.data_table',
                'device_type.dashboard_id',
                'devices.*',
            );
            if ($keyword) {
                $subQuery->orWhere('devices.location', 'LIKE', "%$keyword%");
            }
            $subQuery->where('devices.created_by', Auth::guard('admin')->user()->id);
            $subQuery->Join('device_map', function ($join) {
                $join->on('device_map.MODEM_ID', '=', 'devices.modem_id');
                $join->on('device_map.secret_key', '=', 'devices.secret_key');
            });
            $subQuery->Join('device_status',  'device_status.Client_id', '=', 'device_map.MQTT_ID');
            $subQuery->leftJoin('device_type',  'device_type.id', '=', 'device_map.device_type_id');
            $subQuery->leftJoin('remote',  'remote.MODEM_ID', '=', 'devices.modem_id');
            $subQuery->groupBy('devices.id');
            $device =  $subQuery->latest('devices.created_at')->get();
            // print_r($device);
            // exit;
            return $device;
        }
    }
}
