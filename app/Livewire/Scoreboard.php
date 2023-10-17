<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

use App\Models\Week;
use App\Models\Conference;

class Scoreboard extends Component
{

    public $week;
    public $weeks = [];
    public $conference = 'top';
    public $conferences = [];

    public function mount()
    {
        $this->setFilters();
    }

public function render()
    {

        $data = Week::with('calendar', 'games')->find($this->week);

        $period = [
            'name' => $data->name,
            'dates' => Carbon::parse($data->start_date)->format('M j') . ' - ' . Carbon::parse($data->end_date)->format('M j')
        ];

        $dates = [];

        foreach ($data->games as $game) {

            $date = Carbon::parse($game->start_date)->setTimezone('America/New_York');
            $key = $date->toDateString();

            if ($this->conference == 'top' && ($game->home_rank <= 25 || $game->away_rank <= 25)) {
                if (isset($dates[$key])) {
                    array_push($dates[$key]['games'], $game);
                } else {
                    $dates[$key] = [
                        'display_date' => $date->format('l, F jS'),
                        'games' => [$game]
                    ];
                }
            } else if (
                $this->conference == 'all'
                || ( $game->awayConference && $game->awayConference->id == $this->conference )
                || ( $game->homeConference && $game->homeConference->id == $this->conference )
                ) {

                if (isset($dates[$key])) {
                    array_push($dates[$key]['games'], $game);
                } else {
                    $dates[$key] = [
                        'display_date' => $date->format('l, F jS'),
                        'games' => [$game]
                    ];
                }
            }
        }

        // ddd($dates);
        return view('livewire.scoreboard', [
            'period' => $period,
            'dates' => $dates
        ]);
    }

    public function setFilters()
    {

        $this->week = Week::whereDate('start_date', '<=', now())->whereDate('end_date', '>=', now())->first()->id;

        // Load weeks for the current season
        $weeks = Week::whereHas('calendar', function ($calendar) {
            $calendar->where('year', config('espn.season'));
            $calendar->where('espn_id', '<>', 4); // Off Season
        })
            ->orderBy('start_date')
            ->get();

        // ddd($weeks);

        foreach ($weeks as $week) {
            array_push($this->weeks, [
                'name' => $week->name,
                'value' => $week->id
            ]);
        }

        $conferences = Conference::where('division', 'FBS')->orderBy('abbr')->get();

        array_push($this->conferences, [
            'name' => 'All',
            'value' => 'all'
        ]);

        array_push($this->conferences, [
            'name' => 'Top 25',
            'value' => 'top'
        ]);

        foreach ($conferences as $c) {
            array_push($this->conferences, [
                'name' => $c->abbr,
                'value' => $c->id
            ]);
        }
    }

    public function viewGame($id)
    {
        redirect()->route('game', ['game' => $id]);
    }
}