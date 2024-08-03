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

    #[Url(keep: true, history: true)]
    public $season;

    #[Url(as: 'period', keep: true, history: true)]
    public $week;

    #[Url(keep: true, history: true)]
    public $poll;

    public $current;
    public $defaultPoll;
    public $seasons = [];
    public $weeks = [];
    public $polls = [];

    public function mount()
    {
        $this->setFilters();
    }

    public function render()
    {

        $data = Week::with('rankings')->find($this->week);

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

    public function updatingSeason($season)
    {
        $this->weeks = [];

        $weeks = Week::has('rankings')->whereHas('calendar', function ($calendar) use ($season) {
            $calendar->where('year', $season);
        })
            ->orderBy('start_date')
            ->get();

        foreach ($weeks as $week) {
            array_push($this->weeks, [
                'name' => ($week->name == 'Bowls' ? 'Final' : ($week->name == 'Week 1' ? 'Preseason' : $week->name)),
                'value' => $week->id
            ]);
        }

        $this->week = $weeks[0]->id;
    }

    public function setFilters()
    {

        $available = Week::has('rankings')
            ->latest('start_date')->get();

        $this->current = $available[0]->id;

        if (!isset($this->week)) {
            $this->week = $this->current;
        }

        if (!isset($this->season)) {
            $this->season = $available[0]->calendar->year;
        }

        $addedSeasons = [];
        $latestSeason = $available[0]->calendar->year;

        foreach ($available as $week) {

            if ($week->calendar->year == $latestSeason) {
                array_push($this->weeks, [
                    'name' => ($week->name == 'Bowls' ? 'Final' : ($week->name == 'Week 1' ? 'Preseason' : $week->name)),
                    'value' => $week->id
                ]);
            }

            if (!in_array($week->calendar->year, $addedSeasons)) {
                array_push($this->seasons, [
                    'name' => $week->calendar->year,
                    'value' => $week->calendar->year
                ]);
                array_push($addedSeasons, $week->calendar->year);
            }
        }

        $this->weeks = array_reverse($this->weeks);

        $this->defaultPoll = RankingsController::defaultPoll();

        if (!isset($this->poll)) {
            $this->poll = $this->defaultPoll;
        }

        if ($this->defaultPoll == 'cfp') {
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

        array_push($this->polls, [
            'name' => 'FCS Coaches',
            'value' => 'fcs'
        ]);
    }
}
