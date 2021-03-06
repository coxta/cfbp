<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;

class Lobby extends Component
{

    public $publicGroups, $myGroups;
    public $publicContests, $myContests;

    public function render()
    {
        $this->publicGroups = Group::public()->withCount('members')->get() ?? [];
        if(auth()->check()) {
            $this->myGroups = auth()->user()->groups()->withCount('members')->get() ?? [];
        } else {
            $this->myGroups = [];
        }
        return view('livewire.pickem.lobby');
    }
}
