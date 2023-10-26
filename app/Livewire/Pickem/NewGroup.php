<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;
use App\Models\RecordType;

class NewGroup extends Component
{

    public Group $group;
    public $typeOptions;

    protected $rules = [
        'group.name' => 'required|string|min:3|max:50',
        'group.type_id' => 'required|string|min:3|max:50',
    ];

    public function mount()
    {
        
        $this->group = new Group;

        $this->typeOptions = RecordType::select([
            'id as value',
            'name as name',
            'description as description'
        ])
        ->where('model','Group')
        ->where('name', '!=', 'Master')
        ->orderBy('name', 'desc')
        ->get()
        ->toArray();

        foreach ($this->typeOptions as $type) {
            if($type['name'] == 'Public') {
                $this->group->type_id = $type['value'];
            }
        }

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
