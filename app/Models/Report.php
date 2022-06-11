<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Report extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reports';

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
    protected $fillable = ['device_id', 'device_type_id', 'report_config_id', 'field_name','organization_id'];



    public function getReportsData($type)
    {
        $subQuery =  Report::select(
            'report_configurations.parameter',
            'report_configurations.report_title',
            'devices.modem_id',
            'device_type.device_type',
            'devices.project_name',
            'reports.*',
        );

        $subQuery->join('report_configurations',  'report_configurations.id', '=', 'reports.report_config_id');
        $subQuery->join('device_type',  'device_type.id', '=', 'reports.device_type_id');
        $subQuery->join('devices',  'devices.id', '=', 'report_configurations.device_id');
        if (Auth::guard('admin')->user()->role != 'SUPERADMIN') {
            $subQuery->where('report_configurations.created_by', Auth::guard('admin')->user()->id)->latest()->get();
        }
        if($type == 'count'){
            $report =  $subQuery->latest('reports.created_at')->count();
        }else{
            $report =  $subQuery->latest('reports.created_at')->get();
        }
        
        return $report;
    }
}
