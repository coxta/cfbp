<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;

class ShowGroup extends Component
{
    public $group;

    public function mount(Group $group)
    {
        $this->group = $group;
    }

    public function render()
    {
        return view('livewire.pickem.show-group');
    }
}
