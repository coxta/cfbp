<?php

namespace App\View\Components\Utilities;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UnderConstruction extends Component
{

    public $size;
    
    /**
     * Create a new component instance.
     */
    public function __construct($size = 12)
    {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.utilities.under-construction');
    }
}
