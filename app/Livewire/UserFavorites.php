<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class UserFavorites extends Component
{

    public $teams = [];

    public function mount()
    {
        $this->loadTeams();
    }

    public function render()
    {
        return view('livewire.user-favorites');
    }

    #[On('favorites-updated')]
    public function loadTeams()
    {
        $this->teams = auth()->check() ? User::find(auth()->id())->favorites()->toArray() : [];
    }
}
