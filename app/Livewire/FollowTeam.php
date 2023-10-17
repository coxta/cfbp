<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowTeam extends Component
{
    public $team;
    public $following;

    public function mount($team)
    {
        $this->team = $team;
        $this->following = in_array($this->team, auth()->user()->teams ?? []);
    }

    public function render()
    {
        return view('livewire.follow-team');
    }

    public function toggle()
    {

        $user = User::find(auth()->id());

        $teams = $user->teams ?? [];

        if ($this->following) {
            $index = array_search($this->team, $teams);
            if ($index !== FALSE) {
                unset($teams[$index]);
            }
        } else {
            array_push($teams, $this->team);
        }

        $user->teams = array_unique($teams);
        $user->save();

        $this->following = (bool) !$this->following;

    }
}