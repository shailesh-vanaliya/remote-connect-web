<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportConfiguration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'report_configurations';

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
    protected $fillable = ['report_id', 'device_id', 'organization_id', 'report_title', 'parameter','created_by','updated_by'];

    
}
