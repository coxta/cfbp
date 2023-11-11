<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;
use WireUi\Traits\WireUiActions;

class ShowGroup extends Component
{

    use WireUiActions;

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

    public function notifications()
    {
        if($this->new) {
            $this->notification()->send([
                'icon' => 'success',
                'title' => 'Group created!',
                'description' => 'Create the group ' . $this->group->name,
            ]);
        }
    }

    public function delete()
    {      
        $this->group->delete();
        return redirect()->route('lobby');
    }
}
