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
        $this->log = FeedController::queued('Rankings');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        FeedController::running($this->log, $this->job->payload()['uuid']);

        $weeks = Week::select('number')->whereHas('calendar', function ($calendar) {
            $calendar->where('year', config('espn.season'));
            $calendar->where('espn_id', 2);
        })
            ->orderBy('number')
            ->groupBy('number')
            ->get();

        foreach ($weeks as $week) {

            $response = Http::get(config('espn.rankings') . '?seasons=' . config('espn.season') . '&seasontypes=2&weeks=' . $week->number);
            $rankings = $response->json()['rankings'];

            foreach ($rankings as $poll) {
                if (in_array($poll['type'], ['ap', 'usa','cfp'])) {

                    $poll_date = Carbon::parse($poll['date']);
                    $week_num = $poll['occurrence']['value'];

                    $calendar = Calendar::select('id')
                                    ->whereDate('start_date', '<=', $poll_date)
                                    ->whereDate('end_date', '>=', $poll_date);

                    if($calendar->exists()) {

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

        FeedController::finished($this->log);
    }
}