<?php

namespace App\Jobs\Feeds;

use App\Models\Division;
use App\Models\Conference;

use App\Http\Controllers\FeedController;

use Illuminate\Bus\Queueable;

use Illuminate\Support\Facades\Http;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class Conferences implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

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
        $this->log = FeedController::queued('Conferences');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        FeedController::running($this->log, $this->job->payload()['uuid']);

        $response = Http::get(config('espn.conferences'));
        $conferences = $response->json()['conferences'];

        foreach ($conferences as $conference) {

            if(isset($conference['parentGroupId'])) {

                $div = 'FBS';

                switch ($conference['parentGroupId']) {
                    case '80':
                        $div = 'FBS';
                        break;
                    case '81':
                        $div = 'FCS';
                        break;
                    case '57':
                        $div = 'Div II';
                        break;
                    case '58':
                        $div = 'Div III';
                        break;
                    case '35':
                        $div = 'Div II/III';
                        break;
                    case '99':
                        $div = 'NCAA Football';
                        break;
                    default:
                        $div = 'Unk';
                        break;
                }

                $conf = Conference::updateOrCreate(
                    ['id' => $conference['groupId']],
                    [
                        'name' => $conference['name'],
                        'abbr' => $conference['shortName'],
                        'logo' => $conference['logo'] ?? null,
                        'division' => $div
                    ]
                );

                if(isset($conference['subGroups'])) {
                    foreach ($conference['subGroups'] as $key => $division_id) {
                        $division = Http::get(config('espn.divisions') . $division_id);
                        $data = $division->json()['conferences'][0];

                        $name = explode(' - ', $data['shortName']);

                        $div = Division::updateOrCreate(
                            ['id' => $data['groupId']],
                            [
                                'conference_id' => $conference['groupId'],
                                'name' => $name[1] ?? $name[0]
                            ]
                        );
                    }
                }

            } else {
                $conf = Conference::updateOrCreate(
                    ['id' => $conference['groupId']],
                    [
                        'name' => $conference['name'],
                        'abbr' => $conference['shortName'],
                        'logo' => $conference['logo'] ?? null,
                        'division' => $conference['shortName']
                    ]
                );
                if(isset($conference['subGroups'])) {
                    foreach ($conference['subGroups'] as $key => $division_id) {
                        $division = Http::get(config('espn.divisions') . $division_id);
                        $data = $division->json()['conferences'][0];

                        $name = explode(' - ', $data['shortName']);

                        $div = Division::updateOrCreate(
                            ['id' => $data['groupId']],
                            [
                                'conference_id' => $conference['groupId'],
                                'name' => $name[1] ?? $name[0]
                            ]
                        );
                    }
                }
            }
        }

        // Division II/III Parent for some odd balls
        $div = Division::updateOrCreate(
            ['id' => '35'],
            [
                'conference_id' => '99',
                'name' => 'NCAA Football'
            ]
        );

        FeedController::finished($this->log);

    }
}