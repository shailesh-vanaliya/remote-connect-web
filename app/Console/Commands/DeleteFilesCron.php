<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Config;
class DeleteFilesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deletefile:cron';

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
        $file = new Filesystem;
        $downloadPath = Config::get('constants.path.pdf_download');
        $file->cleanDirectory($downloadPath);
        // $file->cleanDirectory('E:/xampp7.4/htdocs/booking-management-system/public/uploads/signee_pdf/');
        \Log::info("Delete Cron is working fine!");
        $this->info($downloadPath);
        \Log::info($downloadPath);
        $this->info('deletefile:cron command Run successfully!');
    }
}
