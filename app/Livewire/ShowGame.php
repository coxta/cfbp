<?php

namespace App\Livewire;

use App\Models\Game;
use App\Http\Controllers\GameController;
use Livewire\Component;

class ShowGame extends Component
{
    public $game, $summary;

    public function mount($game)
    {
        $sync = GameController::sync($game);
        $this->game = $sync['game'];
        $this->summary = $sync['summary'];
    }

    public function render()
    {
        return view('livewire.show-game');
    }
}