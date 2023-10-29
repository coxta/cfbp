<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Team;

class TeamController extends Controller
{
    public static function sync(int $team) : Team
    {

        $team = Team::find($team);

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

            $wins = 0;
            $losses = 0;
            $conference_wins = 0;
            $conference_losses = 0;

            if($stats) {
                foreach ($stats as $stat) {
                    if($stat['name'] == 'wins') {
                        $wins = $stat['value'];
                    }
                    if($stat['name'] == 'losses') {
                        $losses = $stat['value'];
                    }
                    if($stat['name'] == 'divisionWins') {
                        $conference_wins = $stat['value'];
                    }
                    if($stat['name'] == 'divisionLosses') {
                        $conference_losses = $stat['value'];
                    }
                }
            }

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
            $team->wins = $wins;
            $team->losses = $losses;
            $team->conference_wins = $conference_wins;
            $team->conference_losses = $conference_losses;
            $team->conference_standing = $conference_standing;

            $team->save();

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }

        return $team;

    }
}
