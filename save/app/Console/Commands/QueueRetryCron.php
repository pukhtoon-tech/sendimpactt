<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class QueueRetryCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queueretry:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retry failed queue jobs again';

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
        Artisan::call('queue:retry all');
        return 'Failed queue is retrying';
    }
}
