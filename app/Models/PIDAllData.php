<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PIDAllData extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    protected $table = 'pid_alldata';

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
    protected $fillable = ['id', 'dtm', 'modem_id', 'data'];

    
}
