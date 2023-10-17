<?php

namespace App\View\Components\Utilities;

use Illuminate\View\Component;

class Container extends Component
{

    public $larger, $smaller, $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($largest = false, $larger = false, $smaller = false, $smallest = false)
    {


        $this->class = $smallest ? 'mx-auto max-w-3xl sm:px-20 lg:px-8' : ($largest ? 'mx-auto max-w-screen-3xl sm:px-4 lg:px-10'
        : ($larger ? 'mx-auto max-w-screen-2xl sm:px-4 lg:px-8'
        : ($smaller ? 'mx-auto max-w-5xl sm:px-4 lg:px-8' : 'mx-auto max-w-7xl sm:px-4 lg:px-8')));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utilities.container');
    }
}