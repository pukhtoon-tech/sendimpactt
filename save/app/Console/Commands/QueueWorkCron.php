<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class QueueWorkCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queuewrok:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run queue work in every 1 hour';

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
        Artisan::call('queue:work');
        return 'Queue is running';
    }
}
