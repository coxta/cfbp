<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Team;
use App\Models\Game;

class TeamController extends Controller
{
    public static function sync(int $id) : Team
    {

        $team = Team::findOr($id, function () use($id) {
            $new = new Team;
            $new->id = $id;
            return $new;
        });
        
        try {
            
            $response = Http::get(config('espn.team') . $team->id);
            $data = $response->json()['team'] ?? null;
            
            if(!$data) return $team;
             
            $conference = null;
            $division = null;

            if(isset($data['groups'])) {
                $conference = $data['groups']['isConference'] ? $data['groups']['id'] : $data['groups']['parent']['id'];
                $division = $data['groups']['isConference'] ? null : $data['groups']['id'];
            }


            $logo = isset($data['logos'][0]['href']) ? $data['logos'][0]['href'] : null;

            $stats = $data['record']['items'][0]['stats'] ?? null;

            $conference_standing = $data['standingSummary'] ?? null;

            $records = self::records($team->id);

            $team->conference_id = $conference;
            $team->division_id = $division;
            $team->slug = $data['slug'];
            $team->location = $data['location'];
            $team->name = $data['name'];
            $team->nickname = $data['nickname'];
            $team->abbreviation = $data['abbreviation'];
            $team->display_name = $data['displayName'];
            $team->short_display_name = $data['shortDisplayName'];
            $team->color = $data['color'] ?? null;
            $team->alt_color = $data['alternateColor'] ?? null;
            $team->logo = $logo;
            $team->stats = $stats;
            $team->wins = $records['total_wins'];
            $team->losses = $records['total_losses'];
            $team->conference_wins = $records['conf_wins'];
            $team->conference_losses = $records['conf_losses'];
            $team->conference_standing = $conference_standing;

            $team->save();

        } catch (Exception $e) {
            Log::info($e->getMessage() . ' (' . $e->getFile() . ') [' .  $e->getLine() . ']');
        }

        return $team;

    }

    public static function records($teamId) 
    {

        $records = [
            'total_wins' => 0,
            'total_losses' => 0,
            'conf_wins' => 0,
            'conf_losses' => 0
        ];

        $game = Game::where('home_team', intval($teamId))->orWhere('away_team', intval($teamId))->latest()->first();

        
        if($game) {
            $gameId = $game->id;
        } else {
            return $records;
        }

        
        $request = config('espn.game') . $gameId;
        $data = Http::get($request)->json();
        
        $standings = $data['standings'] ?? [];
        
        foreach($standings['groups'] as $conference) {
            if(isset($conference['divisions'])) {
                foreach($conference['divisions'] as $division) {
                    foreach($division['standings']['entries'] as $team) {
                        if(intval($team['id']) == intval($teamId)) {
                            foreach ($team['stats'] as $record) {
                                if(strtolower($record['abbreviation']) == 'overall') {
                                    $totals = explode('-', $record['summary']);
                                    $records['total_wins'] = (int) $totals[0];
                                    $records['total_losses'] = (int) $totals[1];
                                } elseif (strtolower($record['abbreviation']) == 'conf') {
                                    $confs = explode('-', $record['summary']);
                                    $records['conf_wins'] = (int) $confs[0];
                                    $records['conf_losses'] = (int) $confs[1];
                                }
                            }
                        }
                    }
                }
            } else {
                foreach($conference['standings']['entries'] as $team) {
                    if(intval($team['id']) == intval($teamId)) {
                        foreach ($team['stats'] as $record) {
                            if(strtolower($record['abbreviation']) == 'overall') {
                                $totals = explode('-', $record['summary']);
                                $records['total_wins'] = (int) $totals[0];
                                $records['total_losses'] = (int) $totals[1];
                            } elseif (strtolower($record['abbreviation']) == 'conf') {
                                $confs = explode('-', $record['summary']);
                                $records['conf_wins'] = (int) $confs[0];
                                $records['conf_losses'] = (int) $confs[1];
                            }
                        }
                    }
                }
            }
        }

        return $records;

    }
}
