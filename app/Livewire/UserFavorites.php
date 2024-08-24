<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class UserFavorites extends Component
{

    public function render()
    {
        $teams = auth()->check() ? User::find(auth()->id())->favorites() : null;
        return view('livewire.user-favorites', [
            'teams' => $teams
        ]);
    }

    #[On('favorites-updated')]
    public function favorites()
    {
        // refresh via re-render
    }
}
