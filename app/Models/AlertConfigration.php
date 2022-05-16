<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertConfigration extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alert_configuration';

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
    protected $fillable = ['modem_id', 'organization_id','parameter', 'condition', 'set_value', 'sms_alert', 'email_alert'];

    
}
