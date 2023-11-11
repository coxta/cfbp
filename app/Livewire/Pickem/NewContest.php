<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use App\Models\Group;
use App\Models\Contest;
use App\Models\Week;

class NewContest extends Component
{

    public Contest $contest;
    public Group $group;
    public Week $week;
    public $typeOptions;

    public function rules() {
        return [
            'contest.type_id' => 'required|string|min:36|max:36',
            'contest.group_id' => 'required|string|min:36|max:36',
            'contest.week_id' => 'required|string|min:36|max:36',
        ];
    }

    public function mount(Group $group = null)
    {
        $this->group = $group ?? Group::where('name','Master')->oldest()->first()->id;
        $this->week = Week::current();
        $this->fresh();
    }
    public function render()
    {
        return view('livewire.pickem.new-contest');
    }
    public function cancel()
    {
        $this->dispatch('create-contest-cancelled');
    }

    public function create()
    {

        $this->validate();

        // Set the contest name
        $this->contest->name = strval($this->week->calendar->year);
        $this->contest->name .= ' ' . $this->week->calendar->name;
        $this->contest->name .= ' - ' . $this->week->name;
        $this->contest->name .= ' - ' . Contest::types()->where('id', $this->contest->type_id)->first()->name;

        $this->contest->save();
        session()->flash('new-contest', true);
        return redirect()->route('contest', $this->contest->id);
    }
    public function fresh()
    {

        $this->contest = new Contest;
        $this->typeOptions = Contest::types()->orderBy('name')->get()->toArray();

        // Set a default type
        foreach ($this->typeOptions as $type) {
            if($type['name'] == 'Spreads') {
                $this->contest->type_id = $type['value'];
            }
        }

        // Set the group
        $this->contest->group_id = $this->group->id;

        // Set the week
        $this->contest->week_id = $this->week->id;

        // Set the status
        $this->contest->status = 'Created';

    }
}
