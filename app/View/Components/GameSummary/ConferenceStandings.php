<?php

namespace App\View\Components\GameSummary;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConferenceStandings extends Component
{

    public $conference, $teams;

    /**
     * Create a new component instance.
     */
    public function __construct($conference, $teams)
    {
        $this->conference = $conference;
        $this->teams = $teams;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.game-summary.conference-standings');
    }
}
