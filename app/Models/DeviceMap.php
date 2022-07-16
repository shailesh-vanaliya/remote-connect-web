<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceMap extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'device_map';

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
    protected $fillable = ['model_no','MQTT_ID', 'MODEM_ID', 'device_type_id','secret_key', 'max_user_access', 'IMEI_No', 'SIM_No', 'SIM_Plan', 'subscription_expire_date', 'subscription_status', 'organization_id','created_by', 'updated_by',
    "storage_usage","storage_quota","report_counter","report_quota","sms_counter","sms_quota","email_counter","email_quota","notification_counter","notification_quota"];

    
}
