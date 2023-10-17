<?php

namespace App\View\Components\Utilities;

use Illuminate\View\Component;

class Loader extends Component
{
    public $action, $icon, $size, $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action = null, $icon = null, $size = '4', $color = 'blue-700')
    {

        $this->action = $action;
        $this->icon   = $icon;
        $this->size   = $size;
        $this->color  = $color;

        if ($this->icon && (substr($icon, 0, 2) == 's-' || substr($icon, 0, 2) == 'o-')) {
            $this->icon = 'heroicon-' . $this->icon;
        } else if ($this->icon) {
            $this->icon = 'heroicon-s-' . $this->icon;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utilities.loader');
    }
}