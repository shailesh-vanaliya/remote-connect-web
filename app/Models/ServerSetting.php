<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerSetting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'server_settings';

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
    protected $fillable = ['server_web_address_IP','device_key', 'client_id', 'user_name', 'password', 'data_update_interval', 'port'];

    
}
