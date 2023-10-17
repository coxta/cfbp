<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Network extends Component
{
public $network, $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($network, $size = 3)
    {
        $this->network = $network;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.network');
    }
}