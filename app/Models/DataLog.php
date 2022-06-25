<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLog extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    protected $table = 'datalog';

    /**
    * The database primary key value.
    *
    * @var string
    */
    // protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [ 'id', 'modem_id', 'slave_id', 'Pressure_PV', 'Temperature_PV', 'Waterflow', 'Pressure_SP', 'dtm', 'WATER_VALVE1', 'WATER_VALVE2', 'TOTAL_FLOW', 'DAILY_FLOW', 'MACHINE_STATUS', 'MOISTURE_STATUS', 'CLEAN_ON_TIME', 'CPU_TEMP'];

    
}
