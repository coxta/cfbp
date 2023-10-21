<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    
    public static function sync(int $game) : array
    {
        
        $game = Game::find($game);
        $summary = [];

        try {
            
            $request = config('espn.game') . $game->id;
            $data = Http::get($request)->json();

            $competition = $data['header']['competitions'][0] ?? null;

            if($competition) {

                foreach ($competition['competitors'] as $team) {
                    if ($team['homeAway'] == 'home') {
                        $game->home_score = $team['score'] ?? $game->home_score;
                        $game->home_lines = $team['linescores'] ?? $game->home_lines;
                        $game->home_records = $team['records'] ?? $game->home_records;
                    } else {
                        $game->away_score = $team['score'] ?? $game->away_score;
                        $game->away_lines = $team['linescores'] ?? $game->away_lines;
                        $game->away_records = $team['records'] ?? $game->away_records;
                    }
                }

                $game->status = $competition['status']['type']['name'] ?? $game->status;
                $game->status_desc = $competition['status']['type']['description'] ?? $game->status_desc;
                $game->status_detail = $competition['status']['type']['detail'] ?? $game->status_detail;
                $game->status_detail_short = $competition['status']['type']['shortDetail'] ?? $game->status_detail_short;
                $game->clock = $competition['status']['clock'] ?? $game->clock;
                $game->clock_display = $competition['status']['displayClock'] ?? $game->clock_display;
                $game->period = $competition['status']['period'] ?? $game->period;
                $game->completed = $competition['status']['type']['completed'] ?? $game->completed;

            }

            $game->away_prob = $data['predictor']['awayTeam']['gameProjection'] ?? $game->away_prob;
            $game->home_prob = $data['predictor']['homeTeam']['gameProjection'] ?? $game->home_prob;

            $odds = $data['pickcenter'][0]['details'] ?? null;

            if($odds) {
                if (strtolower($odds) == 'even') {
                    $game->spread = 0;
                    $game->favorite_team = null;
                } else {
                    $fav = explode(' ', $odds);
                    $t = Team::byAbbreviation($fav[0]);
                    if ($t) {
                        $game->favorite_team = $t->id;
                        $game->spread = $fav[1];
                    }
                }
            }

            $game->save();

            $summary['boxscore'] = $data['boxscore'] ?? [];
            $summary['venue'] = $data['gameInfo']['venue'] ?? [];
            $summary['drives'] = $data['drives'] ?? [];
            $summary['leaders'] = $data['leaders'] ?? [];
            $summary['news'] = $data['news']['articles'] ?? [];
            $summary['prediction'] = $data['predictor'] ?? [];
            $summary['probability'] = $data['winprobability'] ?? [];
            $summary['scoring'] = $data['scoringPlays'] ?? [];
            $summary['standings'] = $data['standings'] ?? [];
            $summary['article'] = $data['article'] ?? [];

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        return [
            'game' => $game,
            'summary' => $summary
        ];

    }

}
