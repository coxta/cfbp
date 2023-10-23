<?php

namespace App\Livewire;

use App\Http\Controllers\GameController;
use Livewire\Component;

class ShowGame extends Component
{
    public $id, $game, $summary;

    public function mount($game)
    {
        $this->id = $game;
    }

    public function render()
    {
        $sync = GameController::sync($this->id);
        $this->game = $sync['game'];
        $this->summary = $sync['summary'];
        return view('livewire.show-game');
    }
}