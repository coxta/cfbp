<?php

namespace App\Livewire;

use App\Models\Week;
use App\Models\Ranking;
use Livewire\Component;

class Rankings extends Component
{

    public $week;
    public $weeks = [];
    public $poll = 'ap';
    public $polls = [];

    public function mount()
    {
        $this->setFilters();
    }

    public function render()
    {

        $period = Week::find($this->week)->name;

        $ranks = Ranking::where('poll', $this->poll)
            ->where('week_id', $this->week)
            ->where('rank', '>', 0)
            ->orderBy('rank')
            ->get();

        $dropouts = Ranking::where('poll', $this->poll)
            ->where('week_id', $this->week)
            ->where('rank', 0)
            ->orderBy('previous_rank')
            ->get();

        return view('livewire.rankings', [
            'period' => $period,
            'ranks' => $ranks,
            'dropouts' => $dropouts
        ]);
    }

    public function setFilters()
    {

        $this->week = Week::where('name', 'like', 'Week%')
                    ->where('start_date', '<', now())
                    ->latest('start_date')
                    ->first()
                    ->id;

        // Load weeks for the current season
        $weeks = Week::whereHas('calendar', function ($calendar) {
            $calendar->where('year', config('espn.season'));
        })
            ->where('name', 'like', 'Week%')
            ->orderBy('start_date')
            ->get();

        foreach ($weeks as $week) {
            array_push($this->weeks, [
                'name' => $week->name,
                'value' => $week->id
            ]);
        }

        array_push($this->polls, [
            'name' => 'CFP Rankings',
            'value' => 'cfp'
        ]);

        array_push($this->polls, [
            'name' => 'AP Poll',
            'value' => 'ap'
        ]);

        array_push($this->polls, [
            'name' => 'Coaches Poll',
            'value' => 'coaches'
        ]);
    }
}