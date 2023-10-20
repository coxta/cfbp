<?php

namespace App\View\Components\GameSummary;

use App\Models\Team;
use Illuminate\View\Component;

class Prediction extends Component
{
    public $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    public function render()
    {

        $home = Team::find((int) $this->game['homeTeam']['id']);
        $away = Team::find((int) $this->game['awayTeam']['id']);

        $labels = [
            $home->nickname,
            $away->nickname
        ];

        $colors = [
            '#' . $home->color,
            '#' . $away->color,
        ];

        $chances = [
            floatval($this->game['homeTeam']['gameProjection']),
            floatval($this->game['awayTeam']['gameProjection']),
        ];

        $homeProjection = floatval($this->game['homeTeam']['gameProjection']);
        
        $fav = $home->abbreviation;
        $chance = $this->game['homeTeam']['gameProjection'];
        
        if($homeProjection < 50) {
            $chance = $this->game['awayTeam']['gameProjection'];
            $fav = $away->abbreviation;
        }

        $chance .= '%';

        return view('components.game-summary.prediction',[
            'labels' => $labels,
            'colors' => $colors,
            'fav' => $fav,
            'chance' => $chance,
            'chances' => $chances,
        ]);
    }
}
