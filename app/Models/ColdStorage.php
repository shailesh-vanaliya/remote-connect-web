<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColdStorage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    protected $table = 'cold_storage';

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
    protected $fillable = [  'id', 'modem_id', 'dtm', 'temperature', 'humidity', 'co2'];

    
}
