<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Jobs\Feeds\News;
use App\Jobs\Feeds\Teams;
use App\Jobs\Feeds\Games;
use App\Jobs\Feeds\Rankings;
use App\Jobs\Feeds\SeasonSchedule;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new News)->everyTenMinutes();
        // $schedule->job(new Games)->hourly();
        // $schedule->job(new Teams)->daily();
        // $schedule->job(new Rankings)->daily();
        // $schedule->job(new SeasonSchedule)->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
