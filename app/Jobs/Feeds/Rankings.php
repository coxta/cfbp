<?php

namespace App\Jobs\Feeds;

use Carbon\Carbon;
use App\Models\Week;
use App\Models\Ranking;
use App\Models\Calendar;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\FeedController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Rankings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $log;

    public $tries = 1;
    public $timeout = 300; // Five minutes

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->log = FeedController::queued('Rankings');
        FeedController::running($this->log, $this->job->payload()['uuid']);

        // Load the current polls
        $response = Http::get(config('espn.rankings'));
        $this->loadPolls($response->json()['rankings']);

        $response = Http::get(config('espn.rankings') . '?seasons2023&seasontypes=2&weeks=1');
        $this->loadPolls($response->json()['rankings']);

        $weeks = Week::whereHas('calendar', function ($calendar) {
            $calendar->where('year', config('espn.season'));
        })
            ->orderBy('number', 'desc')
            ->get();

        // Loop current season weeks
        foreach ($weeks as $week) {
            $response = Http::get(config('espn.rankings') . '?seasons=' . $week->calendar->year . '&seasontypes=' . $week->calendar->espn_id . '&weeks=' . $week->number);
            $this->loadPolls($response->json()['rankings']);
        }

        FeedController::finished($this->log);
    }

    public function loadPolls($polls)
    {
        foreach ($polls as $poll) {

            $poll_date = Carbon::parse($poll['date']);
            $week_num = $poll['occurrence']['value'];

            $calendar = Calendar::select('id')
                ->whereDate('start_date', '<=', $poll_date)
                ->whereDate('end_date', '>=', $poll_date);

            if ($calendar->exists()) {

                $calendar_id = $calendar->first()->id;

                $week_id = Week::select('id')
                    ->where('calendar_id', $calendar_id)
                    ->where('number', $week_num)
                    ->first()
                    ->id;

                foreach ($poll['ranks'] as $rank) {
                    $ranking = Ranking::updateOrCreate(
                        [
                            'poll' => $poll['type'] == 'usa' ? 'coaches' : $poll['type'],
                            'calendar_id' => $calendar_id,
                            'week_id' => $week_id,
                            'rank'  => $rank['current']
                        ],
                        [
                            'headline' => $poll['shortHeadline'],
                            'team_id' => $rank['team']['id'],
                            'previous_rank'  => $rank['previous'],
                            'points' => $rank['points'],
                            'votes' => $rank['firstPlaceVotes'],
                            'trend' =>  $rank['trend'],
                            'record' => $rank['recordSummary']
                        ]
                    );
                }
                foreach ($poll['droppedOut'] as $dropout) {
                    $ranking = Ranking::updateOrCreate(
                        [
                            'poll' => $poll['type'] == 'usa' ? 'coaches' : $poll['type'],
                            'calendar_id' => $calendar_id,
                            'week_id' => $week_id,
                            'rank'  => 0,
                            'team_id' => $rank['team']['id']
                        ],
                        [
                            'headline' => $poll['shortHeadline'],
                            'previous_rank'  => $rank['previous'],
                            'points' => $rank['points'],
                            'votes' => $rank['firstPlaceVotes'],
                            'trend' =>  $rank['trend'],
                            'record' => $rank['recordSummary']
                        ]
                    );
                }
            }
        }
    }
}
