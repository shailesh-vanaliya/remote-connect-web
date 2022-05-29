<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honeywell extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    protected $table = 'honeywell_pid';

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
    protected $fillable = ['id', 'modem_id', 'dtm', 'pv1', 'sp1', 'out1', 'obit1', 'pv2', 'sp2', 'out2', 'obit2', 'pv3', 'sp3', 'out3', 'obit3', 'pv4', 'sp4', 'out4', 'obit4', 'pv5', 'sp5', 'out5', 'obit5', 'pv6', 'sp6', 'out6', 'obit6'];

    
}
