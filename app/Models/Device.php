<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devices';

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
    protected $fillable = ['modem_id', 'secret_key', 'project_name', 'customer_name', 'region', 'location', 'machine_type', 'latitude', 'longitude', 'description','created_by', 'updated_by'];

    
}
