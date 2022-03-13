<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemoteServerConfiguration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'remote_server_configuration';

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
    protected $fillable = ['server_web_address_IP', 'device_no','ssh_port', 'user_name', 'password', 'enable_ssh_server_sub', 'status_ssh_server_pub', 'assign_port_ssh_pub', 'created_by', 'updated_by'];

    
}
