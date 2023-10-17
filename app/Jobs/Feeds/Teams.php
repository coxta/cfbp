<?php

namespace App\Jobs\Feeds;

use App\Models\Team;

use App\Http\Controllers\FeedController;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Teams implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

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
        $this->log = FeedController::queued('Teams');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        FeedController::running($this->log, $this->job->payload()['uuid']);

        $response = Http::get(config('espn.teams'));
        $results = $response->json()['sports'][0]['leagues'][0]['teams'];

        foreach ($results as $t) {

            $response = Http::get(config('espn.team') . $t['team']['id']);
            $data = $response->json()['team'] ?? null;

            if(!$data) continue; 

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

            $team = Team::updateOrCreate(
                ['id' => $data['id']],
                [
                    'conference_id' => $conference,
                    'division_id' => $division,
                    'slug' => $data['slug'],
                    'location' => $data['location'],
                    'name' => $data['name'],
                    'nickname' => $data['nickname'],
                    'abbreviation' => $data['abbreviation'],
                    'display_name' => $data['displayName'],
                    'short_display_name' => $data['shortDisplayName'],
                    'color' => $data['color'] ?? null,
                    'alt_color' => $data['alternateColor'] ?? null,
                    'logo' => $logo,
                    'stats' => $stats,
                    'wins' => $wins,
                    'losses' => $losses,
                    'conference_wins' => $conference_wins,
                    'conference_losses' => $conference_losses,
                    'conference_standing' => $conference_standing
                ]
            );

        }

        FeedController::finished($this->log);

    }
}