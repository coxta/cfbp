<?php

namespace App\Livewire;

use App\Models\Team;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ShowTeam extends Component
{

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

    public function mount(Team $team)
    {
        $this->team = $team;
        $this->games = $this->team->games()->get();
        $this->loadNews();
        $this->cleanStats();
    }

    public function render()
    {
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