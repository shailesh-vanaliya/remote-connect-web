<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notification';

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
    protected $fillable = ['modem_id','organization_id', 'alert_message', 'viewed', 'is_email_send', 'is_sms_send', 'is_ack', 'created_by','updated_by'];

    
}
