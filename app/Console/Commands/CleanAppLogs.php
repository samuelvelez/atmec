<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanAppLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applogs:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean laravel_logger_activity table keeping only las 72 hours records';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Cleaning laravel_logger_activity table');
        $start = Carbon::now();
        $records = DB::table('laravel_logger_activity')->where('created_at', '<', Carbon::now()->subDays(env('APP_LOG_RETENTION_DAYS', 3)))->delete();
        $end = Carbon::now();
        $this->line('Job started at: ' . $start . '. Deleted ' . $records . ' records.' . ' Ended at: ' . $end);
    }
}
