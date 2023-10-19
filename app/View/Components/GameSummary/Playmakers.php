<?php

namespace App\View\Components\GameSummary;

use Illuminate\View\Component;

class Playmakers extends Component
{

    public $game;

    public function __construct($game)
    {
        $this->game = $game;
    }

    public function render()
    {

        $stats = [];

        foreach ($this->game[0]['leaders'] as $key => $stat) {

            $statName = $stat['displayName'];
            $leaders = [];

            array_push($leaders, [
                'name' => $stat['leaders'][0]['athlete']['shortName'] ?? null,
                'headshot' => $stat['leaders'][0]['athlete']['headshot']['href'] ?? null,
                'team' => $this->game[0]['team']['abbreviation'] ?? null,
                'value' => $stat['leaders'][0]['displayValue'] ?? null,
            ]);

            array_push($leaders, [
                'name' => $this->game[1]['leaders'][$key]['leaders'][0]['athlete']['shortName'] ?? null,
                'headshot' => $this->game[1]['leaders'][$key]['leaders'][0]['athlete']['headshot']['href'] ?? null,
                'team' => $this->game[1]['team']['abbreviation'] ?? null,
                'value' => $this->game[1]['leaders'][$key]['leaders'][0]['displayValue'] ?? null,

            ]);

            array_push($stats, [
                'stat' => $statName,
                'leaders' => $leaders
            ]);
        }

        return view('components.game-summary.playmakers', [
            'stats' => $stats
        ]);

    }
}
