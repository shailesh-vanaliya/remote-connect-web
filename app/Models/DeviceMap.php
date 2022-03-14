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
    protected $fillable = ['MQTT_ID', 'MODEM_ID', 'secret_key', 'max_user_acess', 'IMEI_No', 'SIM_No', 'SIM_Plan', 'subscription_expire_date', 'subscription_status', 'created_by', 'updated_by'];

    
}
