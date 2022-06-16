<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceAliasmap extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'device_aliasmap';

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
    protected $fillable = [ "modem_id", "dashboard_alias", 'device_type',"parameter_alias", "created_by", "updated_by", "created_at", "updated_at","chart_alias"];

    
}
