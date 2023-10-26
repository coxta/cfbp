<?php

namespace App\Livewire\Pickem;

use Livewire\Component;

class NewGroup extends Component
{
    public function render()
    {
        return view('livewire.pickem.new-group');
    }

    public function cancel()
    {
        $this->dispatch('create-group-cancelled'); 
    }
}
