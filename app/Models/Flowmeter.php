<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flowmeter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    protected $table = 'flowmeter';

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
    protected $fillable = ['id', 'modem_id', 'dtm', 'flm_no', 'ss', 'D0', 'D1', 'D2', 'D3', 'D4', 'D5'];
}
