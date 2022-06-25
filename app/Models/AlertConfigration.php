<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
    protected $fillable = ['modem_id', 'organization_id', 'parameter', 'condition', 'set_value', 'sms_alert', 'email_alert', 'created_by', 'updated_by','alert_message','alert_type'];


    public function getAlertCong($postData)
    {
        $subQuery =  AlertConfigration::select(
            'alert_configuration.*',
            'devices.modem_id',
        );

        if (Auth::guard('admin')->user()->role == "ADMIN") {
            $subQuery->where('devices.organization_id', Auth::guard('admin')->user()->organization_id);
        } else if (Auth::guard('admin')->user()->role == "USER") {
            $subQuery->where('devices.created_by', Auth::guard('admin')->user()->id);
        }

        $subQuery->leftJoin('devices',  'devices.id', '=', 'alert_configuration.modem_id');
        $alertResult =  $subQuery->latest('devices.created_at')->get();

        return $alertResult;
    }
}
