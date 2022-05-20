<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'device_type';

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
    protected $fillable = ['device_type' , 'created_at', 'updated_at', 'created_by', 'updated_by'];

    
}
