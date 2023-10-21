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
        return view('components.game-summary.playcast');
    }
}
