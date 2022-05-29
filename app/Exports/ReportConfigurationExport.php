<?php

namespace App\Exports;
use App\Models\DataLog;
use App\Models\ReportConfiguration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class ReportConfigurationExport implements FromCollection
{
    protected $data;

    function __construct($post)
    {
        $this->data = $post;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $aaaa = json_decode($this->data['parameter']);
        // return ReportConfiguration::all();
        $this->data['parameter'] = str_replace("[","",$this->data['parameter']);
        $this->data['parameter'] = str_replace("]","",$this->data['parameter']);
        // $this->data['parameter'] = str_replace('"',"''",$this->data['parameter']);

        // print_r($this->data['modem_id']);
        // exit;
        // $string = "'modem_id','Pressure_PV'";
        $string = $this->data['parameter'];
        // $string = str_replace(",","','",$string);
        // $string = "'".$string."'";
        
        // echo $string;exit;;
        try {
          
            // $res  =  DataLog::select($this->data['parameter'])
            // $res  =  DataLog::select('modem_id','slave_id')
            $res  =  DataLog::selectRaw($string)
            // $res  =  DataLog::select(
            //     'modem_id',
            //     'Pressure_PV',
            //     'Temperature_PV',
            //     'Waterflow',
            //     'Pressure_SP',
            //     'dtm',
            //     'WATER_VALVE1',
            //     'WATER_VALVE2',
            //     'TOTAL_FLOW',
            //     'DAILY_FLOW',
            //     'MACHINE_STATUS',
            //     'MOISTURE_STATUS',
            //     'CLEAN_ON_TIME',
            //     'CPU_TEMP'
            // )
            ->where("modem_id", $this->data['modem_id'])
            // ->where("modem_id", 'FT104')
            // ->take(5)
                ->get();
                // print_r($res);
                // exit;
                // foreach( $res as $key => $val){
                // unset($val[12]);
                // }
                // print_r($res);
                // exit;
                return $res;
        } catch (Exception $e) {
            return redirect('admin/report')->with('session_error', $e->getMessage());
        }
        
    }

    public function getCsvSettings(): array
    {
        return [
            // 'delimiter' => ';'
        ];
    }

    public function headings(): array
    {
        return $this->data['parameter'];
        // return ['modem id',  'Pressure PV', 'Temperature PV', 'Waterflow', 'Pressure SP', 'Timestamp', 'WATER VALVE1', 'WATER VALVE2', 'TOTAL FLOW', 'DAILY FLOW', 'MACHINE STATUS', 'MOISTURE STATUS', 'CLEAN ON TIME', 'CPU TEMP'];
    }
}
