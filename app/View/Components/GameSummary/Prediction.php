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

        $fav = floatval($this->game['homeTeam']['gameProjection']) >= 50 
                ? $home->abbreviation . ' ' . $this->game['homeTeam']['gameProjection'] . '%' 
                : $away->abbreviation . ' ' . $this->game['awayTeam']['gameProjection'] . '%' ;

        return view('components.game-summary.prediction',[
            'labels' => $labels,
            'colors' => $colors,
            'chances' => $chances,
            'fav' => $fav
        ]);
    }
}
