<?php

namespace App\View\Components\Utilities;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Choice extends Component
{
    
    public $options;
    public $current;
    /**
     * Create a new component instance.
     */
    public function __construct($options, $current)
    {
        $this->options = $options;
        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utilities.choice');
    }
}
