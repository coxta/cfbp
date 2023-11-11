<?php

namespace App\Livewire\Pickem;

use Livewire\Component;
use WireUi\Traits\WireUiActions;
use Carbon\Carbon;

use App\Models\Contest;
use App\Models\Week;
use App\Models\Game;
use App\Models\Conference;
use App\Models\Selection;

class ShowContest extends Component
{

    use WireUiActions;

    public Contest $contest;

    public $conference = 'top';
    public $conferences = [];    

    public function mount(Contest $contest)
    {
        $this->contest = $contest;
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

    public function render()
    {

        $data = Week::with('calendar', 'games')->find($this->contest->week_id);

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

        return view('livewire.pickem.show-contest', [
            'period' => $period,
            'dates' => $dates
        ]);
    }

    public function selection($gameId)
    {

        $game = Game::find($gameId);

        $this->dialog()->confirm([
            'title' => 'Add this Game?',
            'description' => $game->name,
            'icon' => 'success',
            'accept' => [
                'label' => 'Yes, add it!',
                'method' => 'addGame',
                'params' => $gameId,
            ],
            'reject' => [
                'label' => 'No, cancel',
            ],
        ]);
    }

    public function dropSelection($gameId)
    {

        $game = Game::find($gameId);

        $this->dialog()->confirm([
            'title' => 'Remove this Game?',
            'description' => $game->name,
            'icon' => 'error',
            'accept' => [
                'label' => 'Yes, remove it!',
                'method' => 'removeGame',
                'params' => $gameId,
            ],
            'reject' => [
                'label' => 'No, keep it',
            ],
        ]);
    }

    public function addGame($gameId)
    {

        $game = Game::find($gameId);

        $this->contest->selections()->firstOrCreate(
            ['game_id' => $gameId],
            [
                'favorite_id' => $game->favorite_team,
                'spread' => abs($game->spread),
                'points' => 10
            ]
        );
        $this->continue();
    }

    public function removeGame($gameId)
    {
        Selection::where('contest_id', $this->contest->id)->where('game_id', $gameId)->delete();
        $this->continue();
    }

    public function submit()
    {
        $this->contest->status = 'Submitted';
    }

    public function continue()
    {
        $this->contest->refresh();
    }

}
