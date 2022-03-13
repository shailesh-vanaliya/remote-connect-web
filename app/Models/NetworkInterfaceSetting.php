<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetworkInterfaceSetting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'network_interface_setting';

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
    protected $fillable = ['ethernet_ipv4', 'user_id','ethernet_mask', 'ethernet_gateway', 'ethernet_dns', 'ethernet_mode', 'wifi_ipv4', 'wifi_mask', 'wifi_gateway', 'wifi_dns', 'wifi_ssid', 'wifi_password', 'wifi_mode', '4g_lte', '4g_lte_user', '4g_lte_password', '4g_lte_apn'];

    
}
