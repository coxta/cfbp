<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\TeamController;

class ShowTeam extends Component
{

    public $id;
    public $team;
    public $games;
    public $articles = [];
    public $stats = [];

    private $relativeStats = [
        'wins',
        'losses',
        'winPercent',
        'pointsFor',
        'pointsAgainst',
        'avgPointsFor',
        'avgPointsAgainst'
    ];

    private $statLabels = [
        'wins' => 'Wins',
        'losses' => 'Losses',
        'winPercent' => 'Win %',
        'pointsFor' => 'Total Points',
        'pointsAgainst' => 'Total Allowed',
        'avgPointsFor' => 'Avg Points',
        'avgPointsAgainst' => 'Avg Allowed'
    ];

    public function mount($team)
    {
        $this->id = $team;
    }

    public function render()
    {
        $this->team = TeamController::sync(intval($this->id));
        $this->games = $this->team->games()->get();
        $this->loadNews();
        $this->cleanStats();
        return view('livewire.show-team');
    }

    public function loadNews()
    {
        $response = Http::get(config('espn.team-news') . $this->team->id);
        $this->articles = $response->json()['articles'];
    }

    public function cleanStats()
    {

        if($this->team->stats && count($this->team->stats) > 0) {

            foreach ($this->team->stats as $stat) {

                if(in_array($stat['name'], $this->relativeStats)) {
                    array_push($this->stats, [
                        'label' => $this->statLabels[$stat['name']],
                        'value' => round($stat['value'],2)
                    ]);
                }

            }

        }

    }

}