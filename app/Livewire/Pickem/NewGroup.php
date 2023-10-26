<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;

class NewGroup extends Component
{

    public Group $group;

    protected $rules = [
        'group.name' => 'required|string|min:3|max:50',
    ];

    public function mount()
    {
        $this->group = new Group;
    }
    public function render()
    {
        return view('livewire.pickem.new-group');
    }

    public function cancel()
    {
        $this->dispatch('create-group-cancelled'); 
    }
}
