<?php

namespace App\Jobs\Feeds;

use Carbon\Carbon;

use App\Models\Calendar;
use App\Models\Week;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;

use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\FeedController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Calendars implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $log;

    public $tries = 1;
    public $timeout = 120; // Two minutes

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->log = FeedController::queued('Calendars');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        FeedController::running($this->log, $this->job->payload()['uuid']);

        $response = Http::get(config('espn.games'));

        $calendars = $response->json()['leagues'][0]['calendar'];

        $year = $response->json()['leagues'][0]['season']['year'];

        foreach ($calendars as $cal) {

            $start = Carbon::parse($cal['startDate'], 'UTC');
            $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start);
            $end = Carbon::parse($cal['endDate'], 'UTC');
            $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $end);

            $calendar = Calendar::updateOrCreate(
                ['espn_id' => $cal['value']],
                [
                    'name' => $cal['label'],
                    'year' => $year,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                ]
            );

            $weeks = $cal['entries'];

            foreach ($weeks as $week) {

                $start = Carbon::parse($week['startDate'], 'UTC');
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start);
                $end = Carbon::parse($week['endDate'], 'UTC');
                $end_date = Carbon::createFromFormat('Y-m-d H:i:s', $end);

                $wk = Week::updateOrCreate(
                    [
                        'calendar_id' => $calendar->id,
                        'number' => $week['value']
                    ],
                    [
                        'name' => $week['label'],
                        'description' => $week['detail'],
                        'start_date' => $start_date,
                        'end_date' => $end_date
                    ]
                );
            }
        }

        FeedController::finished($this->log);
    }
}