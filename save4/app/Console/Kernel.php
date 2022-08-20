<?php

namespace App\Console;

use Artisan;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\QueueWorkCron::class,
        Commands\QueueRetryCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $seconds = 5;

        $schedule->call(function () use ($seconds) {
            $dt = Carbon::now();

            $x = 60 / $seconds;

            do {
                Log::info('Cron job started at '.$dt->toDateTimeString());
                Artisan::call('patch:update');

                time_sleep_until($dt->addSeconds($seconds)->timestamp);
            } while ($x-- > 0);
        })->everyMinute($seconds);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
