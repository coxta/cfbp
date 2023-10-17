<?php

namespace App\Jobs\Feeds;

use Carbon\Carbon;

use App\Models\Game;
use App\Models\Team;

use App\Models\Calendar;
use Carbon\CarbonPeriod;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\FeedController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SeasonSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $log;

    public $tries = 1;
    public $timeout = 600; // Ten minutes

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->log = FeedController::queued('SeasonSchedule');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        FeedController::running($this->log, $this->job->payload()['uuid']);

        $calendars = Calendar::select(DB::raw('min(start_date) as from_dt'), DB::raw('max(end_date) as thru_dt'))
            ->where('year', Carbon::now()->year)
            ->where('name', '<>', 'Off Season')
            ->groupBy('year')
            ->first();

        $from = Carbon::parse($calendars['from_dt']);
        $thru = Carbon::parse($calendars['thru_dt']);

        $dates = CarbonPeriod::make($from, $thru);

        foreach ($dates as $date) {

            $day = $date->format('Ymd');

            $dateRequest = config('espn.games') . '&calendar=blacklist&dates=' . $day;

            $response = Http::get($dateRequest);
            $games = $response->json()['events'] ?? null;

            if(!$games) continue;

            if (count($games) > 0) {

                foreach ($games as $game) {

                    try {

                        $g = $game['competitions'][0];

                        $start = Carbon::parse($g['date']);
                        $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $start);

                        $home_team = null;
                        $home_rank = 99;
                        $home_score = 0;
                        $home_lines = null;

                        $away_team = null;
                        $away_rank = 99;
                        $away_score = 0;
                        $away_lines = null;
                        $teams = [];

                        foreach ($g['competitors'] as $team) {

                            array_push($teams, intval($team['team']['id']));

                            if ($team['homeAway'] == 'home') {
                                $home_team = $team['team']['id'] > 0 ? $team['team']['id'] : 0;
                                $home_score = $team['score'];
                                $home_lines = $team['linescores'] ?? null;
                                $home_records = $team['records'] ?? null;
                                $home_rank = $team['curatedRank']['current'] ?? 99;
                            } else {
                                $away_team = $team['team']['id'] > 0 ? $team['team']['id'] : 0;
                                $away_score = $team['score'];
                                $away_lines = $team['linescores'] ?? null;
                                $away_records = $team['records'] ?? null;
                                $away_rank = $team['curatedRank']['current'] ?? 99;
                            }
                        }

                        $spread = null;
                        $favorite = null;
                        $odds = null;

                        if (isset($g['odds'][0]['details'])) {
                            $odds = $g['odds'][0]['details'];
                            if (strtolower($g['odds'][0]['details']) == 'even') {
                                $spread = 0;
                                $favorite = null;
                            } else {
                                $fav = explode(' ', $g['odds'][0]['details']);
                                $t = Team::where('abbreviation', $fav[0])->first();
                                if ($t) {
                                    $favorite = $t->id;
                                    $spread = $fav[1];
                                }
                            }
                        }

                        $record = Game::updateOrCreate(
                            ['id' => $game['id']],
                            [
                                'name' => $game['name'],
                                'start_date' => $start_date,
                                'short_name' => $game['shortName'],
                                'game_type' => $g['type']['abbreviation'],
                                'game_type_id' => $g['type']['id'],
                                'venue' => $g['venue'] ?? null,
                                'attendance' => $g['attendance'] ?? 0,
                                'notes' => $g['notes'] ?? null,
                                'situation' => $g['situation'] ?? null,
                                'leaders' => $g['leaders'] ?? null,
                                'broadcasts' => $g['broadcasts'] ?? null,
                                'teams' => $teams,
                                'home_team' => $home_team,
                                'home_rank' => $home_rank,
                                'home_score' => $home_score,
                                'home_lines' => $home_lines,
                                'home_records' => $home_records,
                                'away_team' => $away_team,
                                'away_rank' => $away_rank,
                                'away_score' => $away_score,
                                'away_lines' => $away_lines,
                                'away_records' => $away_records,
                                'odds'  => $odds,
                                'favorite_team' => $favorite,
                                'spread' => $spread,
                                'status' => $game['status']['type']['name'],
                                'status_desc' => $game['status']['type']['description'],
                                'status_detail' => $game['status']['type']['detail'],
                                'status_detail_short' => $game['status']['type']['shortDetail'],
                                'clock' => $game['status']['clock'],
                                'clock_display' => $game['status']['displayClock'],
                                'period' => $game['status']['period'],
                                'completed' => $game['status']['type']['completed']
                            ]
                        );
                    } catch (\Throwable $th) {
                        // Throw!
                    }
                }
            }
        }

        FeedController::finished($this->log);
    }
}