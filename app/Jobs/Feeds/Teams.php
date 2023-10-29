<?php

namespace App\Jobs\Feeds;

use App\Http\Controllers\TeamController;

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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->log = FeedController::queued('Teams');
        FeedController::running($this->log, $this->job->payload()['uuid']);

        $response = Http::get(config('espn.teams'));
        $results = $response->json()['sports'][0]['leagues'][0]['teams'];

        foreach ($results as $result) {

            TeamController::sync($result['team']['id']);

        }

        FeedController::finished($this->log);

    }
}