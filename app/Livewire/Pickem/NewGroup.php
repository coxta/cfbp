<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Group;
use App\Models\RecordType;

class NewGroup extends Component
{

    public Group $group;
    public $typeOptions;

    // 'group.name' => 'required|string|min:3|max:100|unique:groups,name',

    public function rules() {
        return [
            'group.name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('groups','name')->whereNull('deleted_at')
            ],
            'group.type_id' => 'required|string|min:36|max:36',
            'group.user_id' => 'required|string|min:36|max:36',
        ];
    }

    public function messages() 
    {
        return [
            'group.name.unique' => 'Sorry, this name has been taken'
        ];
    }

    public function mount()
    {
        $this->fresh();
    }

    public function render()
    {
        return view('livewire.pickem.new-group');
    }

    public function fresh()
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

        $this->group->user_id = auth()->id();
    }

    public function cancel()
    {
        $this->dispatch('create-group-cancelled'); 
    }

    public function create()
    {
        
        $this->validate();
        $this->group->save();

        session()->flash('new-group', true);

        return redirect()->route('group', $this->group->id);
    }
}
