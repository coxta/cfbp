<?php

namespace App\View\Components\GameSummary;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Playcast extends Component
{

    public $drives, $scoring;

    /**
     * Create a new component instance.
     */
    public function __construct($drives, $scoring)
    {
        $this->drives = $drives;
        $this->scoring = $scoring;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $currentDrive = $this->drives['current'] ?? null;

        $current = [];

        if($currentDrive) {
            $playCount = count($currentDrive['plays']);
            $lastPlay = $currentDrive['plays'][$playCount - 1];
            $current['down'] = $lastPlay['end']['shortDownDistanceText'] ?? $lastPlay['start']['shortDownDistanceText'];
            $current['yardline'] = $lastPlay['end']['yardLine'] ?? $lastPlay['start']['yardLine'];
            $current['summary'] = $currentDrive['description'];
            $current['last'] = $lastPlay;

            // ddd($current['last']['start']['downDistanceText']);
        }

        return view('components.game-summary.playcast', [
            'current' => $current
        ]);
    }
}
