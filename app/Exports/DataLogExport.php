<?php

namespace App\Exports;

use App\Models\DataLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataLogExport implements FromCollection, WithCustomCsvSettings, WithHeadings
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
        try {

            if (empty($start) && empty($end)) {
                $start = date('Y-m-d');
                $end = date('Y-m-d');
            } else {
                $start = date('Y-m-d', strtotime($this->data['start']));
                $end = date('Y-m-d', strtotime($this->data['end']));
            }
            return DataLog::select(
                'modem_id',
                'dev_id',
                'Pressure_PV',
                'Temperature_PV',
                'Waterflow',
                'Pressure_SP',
                'Timestamp',
                'WATER_VALVE1',
                'WATER_VALVE2',
                'TOTAL_FLOW',
                'DAILY_FLOW',
                'MACHINE_STATUS',
                'MOISTURE_STATUS',
                'CLEAN_ON_TIME',
                'CPU_TEMP'
            )->where("modem_id", 'FT104/')
                ->whereRaw(
                    "(Timestamp >= ? AND Timestamp <= ?)",
                    [$start . " 00:00:00", $end . " 23:59:59"]
                )
                ->get();
        } catch (Exception $e) {
            return redirect('admin/meter_dashboard')->with('session_error', $e->getMessage());
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
        return ['modem id', 'dev id', 'Pressure PV', 'Temperature PV', 'Waterflow', 'Pressure SP', 'Timestamp', 'WATER VALVE1', 'WATER VALVE2', 'TOTAL FLOW', 'DAILY FLOW', 'MACHINE STATUS', 'MOISTURE STATUS', 'CLEAN ON TIME', 'CPU TEMP'];
    }
}