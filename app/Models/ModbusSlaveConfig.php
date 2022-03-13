<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModbusSlaveConfig extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modbus_slave_config';

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
    protected $fillable = ['interface', 'ipv4','device_no', 'port', 'baudrate', 'stopbit', 'data_length', 'parity', 'modbus_id', 'word_byte_order', 'created_by', 'updated_by'];

    
}
