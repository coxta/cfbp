<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;
use App\Models\User;

class Lobby extends Component
{

    public $publicGroups, $myGroups;

    public function render()
    {
        $this->publicGroups = Group::public()->get();
        $this->myGroups = auth()->user()->groups()->get() ?? null;
        return view('livewire.pickem.lobby');
    }
}
