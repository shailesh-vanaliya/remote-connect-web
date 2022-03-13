<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ModbusSlaveAddressMapping extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modbus_slave_address_mapping';

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
    protected $fillable = ['device_no', 'modbus_address', 'point_type', 'length', 'data_type', 'decimal_point', 'publish_tag', 'sub_tag', 'alarm_high_sp', 'alarm_low_sp', 'alarm_latch_time', 'created_by', 'updated_by'];

    public function createRecord($row)
    {
        $obj = new ModbusSlaveAddressMapping();
        $obj->point_type = $row[0];
        $obj->device_no = (isset($row[1]) ? $row[1] : '');
        $obj->modbus_address = (isset($row[2]) ? $row[2] : '');
        $obj->length = (isset($row[3]) ? $row[3] : '');
        $obj->data_type =(isset($row[4]) ? $row[4] : '');
        $obj->decimal_point =(isset($row[5]) ? $row[5] : '');
        $obj->publish_tag =(isset($row[6]) ? $row[6] : '');
        $obj->sub_tag = (isset($row[7]) ? $row[7] : '');
        $obj->alarm_high_sp = (isset($row[8]) ? $row[8] : '');
        $obj->alarm_low_sp = (isset($row[9]) ? $row[9] : '');
        $obj->alarm_latch_time = (isset($row[10]) ? $row[10] : '');
        $obj->updated_at =  date('Y-m-d h:i:s');
        $obj->created_at =  date('Y-m-d h:i:s');
        $obj->created_by = Auth::guard('admin')->user()->id;
        $obj->updated_by = Auth::guard('admin')->user()->id;
     
        $obj->save();
    }
}
