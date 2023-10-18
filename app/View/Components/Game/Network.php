<?php

namespace App\View\Components\Game;

use Illuminate\View\Component;

class Network extends Component
{
    public $network, $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($game, $size = '2')
    {
        
        $network = $game->broadcasts[0]['names'][0] ?? '';

        switch ($network) {
            case 'CW NETWORK':
                $this->network = 'CW';
                break;
            default:
                $this->network = $network;
                break;
        }

        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.game.network');
    }
}