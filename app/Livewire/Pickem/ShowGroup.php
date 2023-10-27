<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;

class ShowGroup extends Component
{
    public $group;
    public $new;

    public function mount(Group $group)
    {
        $this->group = $group;
        $this->new = session()->has('new-group');
    }

    public function render()
    {
        return view('livewire.pickem.show-group');
    }

    public function delete()
    {
        $this->group->delete();
        return redirect()->route('lobby');
    }
}
