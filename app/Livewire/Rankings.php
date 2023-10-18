<?php

namespace App\Livewire;

use App\Http\Controllers\RankingsController;
use Carbon\Carbon;
use App\Models\Week;
use App\Models\Ranking;
use Livewire\Component;
use Livewire\Attributes\Url;

class Rankings extends Component
{

    #[Url(as: 'period', keep:true, history: true)]
    public $week;

    #[Url(keep: true, history: true)] 
    public $poll;

    public $current;
    public $defaultPoll;
    public $weeks = [];
    public $polls = [];

    public function mount()
    {
        $this->setFilters();
    }

    public function render()
    {

        $data = Week::find($this->week);

        $period = [
            'name' => $data->name,
            'dates' => Carbon::parse($data->start_date)->format('M j') . ' - ' . Carbon::parse($data->end_date)->format('M j')
        ];

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

    public function defaults()
    {
        $this->week = $this->current;
        $this->poll = $this->defaultPoll;
    }

    public function setFilters()
    {

        $this->current = Week::whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->first()->id;
        if(!isset($this->week)) {
            $this->week = $this->current;
        }

        $this->defaultPoll = RankingsController::defaultPoll();
        if(!isset($this->poll)) {
            $this->poll = $this->defaultPoll;
        }

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

        if($this->defaultPoll == 'cfp') {
            array_push($this->polls, [
                'name' => 'CFP',
                'value' => 'cfp'
            ]);
        }

        array_push($this->polls, [
            'name' => 'AP',
            'value' => 'ap'
        ]);

        array_push($this->polls, [
            'name' => 'Coaches',
            'value' => 'coaches'
        ]);
    }
}