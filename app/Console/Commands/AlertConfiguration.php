<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AlertConfiguration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alertConfig:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Log::info(date('Y-m-d H:i:s') . " - Alert Configuration command Run successfully!");
        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $_SERVER['APP_URL']. '/document-cron',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        // ));

        // $response = curl_exec($curl);
        // curl_close($curl);
        $this->info('Alert Configuration command Run successfully!');
        return 0;
    }
}
