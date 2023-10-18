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
        /**
         * Weekdays
         */
        $schedule->job(new Games)->weekdays()->everyFourHours()->between('6:00', '22:00')->timezone('America/New_York'); // Games every 4 hrs on weekdays
        $schedule->job(new News)->weekdays()->everyThreeHours()->between('6:00', '22:00')->timezone('America/New_York'); // News at mid-hour
        
        /**
         * Weekends
         */
        $schedule->job(new Rankings)->weeklyOn(1, '5:00')->timezone('America/New_York'); // Mondays @ 5am EST
        $schedule->job(new SeasonSchedule)->weeklyOn(1, '6:00')->timezone('America/New_York'); // Mondays @ 6am EST
        $schedule->job(new Teams)->weeklyOn(1,'7:00')->timezone('America/New_York'); // Mondays @ 7am EST

        /**
         * Rapid Game sync on saturdays
         */

        // Hourly in the early morning
        $schedule->job(new Games)->saturdays()->hourly()->between('1:00', '9:00')->timezone('America/New_York');

        // Every 15 minutes during College Gameday
        $schedule->job(new Games)->saturdays()->everyFifteenMinutes()->between('9:15', '12:00')->timezone('America/New_York');

        // Every 5 minutes while live
        $schedule->job(new Games)->saturdays()->everyFiveMinutes()->between('12:05', '23:55')->timezone('America/New_York');

        // Every 15 minutes for a few hours on Sunday for the west coast games
        $schedule->job(new Games)->sundays()->everyFifteenMinutes()->between('00:05', '03:00')->timezone('America/New_York');

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
