<?php

namespace App\Exports;
use App\Models\DataLog;
use App\Models\Honeywell;
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

                                              
        // $string = "'modem_id','Pressure_PV'";
        $string = $this->data['parameter'];
        // $string = str_replace(",","','",$string);
        // $string = "'".$string."'";
        
        // echo $string;exit;;
        try {
            $start = $this->data['start'].":00";
            $end = $this->data['end'].":00";
            // $res  =  DataLog::select($this->data['parameter'])
            // $res  =  DataLog::select('modem_id','slave_id')
            if($this->data['data_table'] == 'honeywell_pid'){
                $res  =  Honeywell::selectRaw($string)
                ->where("modem_id", $this->data['modem_id'])
                ->whereRaw(
                    "(dtm >= ? AND dtm <= ?)",
                    [$start, $end ]
                )->get();
            }else{
                $res  =  DataLog::selectRaw($string)
            ->where("modem_id", $this->data['modem_id'])
            ->whereRaw(
                "(dtm >= ? AND dtm <= ?)",
                [$start, $end ]
            )->get();
            }
            

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
