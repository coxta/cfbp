<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Team;
use App\Models\Conference;

class Teams extends Component
{

    #[Url(as: 'div', keep: true, history: true)]
    public $division = 'FBS';

    #[Url(as: 'conf', keep: true, history: true)]
    public $conference = 0;

    public $divisions = [];
    public $conferences = [];

    public $conferenceIds = [];

    public $teams;
    
    public function render()
    {
        $this->filters();
        $this->teams();
        return view('livewire.teams');
    }

    public function teams()
    {
        if($this->conference > 0) {
            $this->teams = Team::without('conference')
                            ->select([
                                'teams.id',
                                'teams.name',
                                'teams.location',
                                'teams.logo',
                                'teams.wins',
                                'teams.losses',
                                'teams.conference_wins',
                                'teams.conference_losses',
                                'conferences.id as conference_id',
                                'conferences.abbr as conference_abbr'
                            ])
                            ->join('conferences', 'conferences.id', '=', 'teams.conference_id')
                            ->where('conference_id', $this->conference)
                            ->orderBy('conferences.abbr')
                            ->orderBy('teams.location')
                            ->get();
        } else {
            $this->teams = Team::without('conference')
                            ->select([
                                'teams.id',
                                'teams.name',
                                'teams.location',
                                'teams.logo',
                                'teams.wins',
                                'teams.losses',
                                'teams.conference_wins',
                                'teams.conference_losses',
                                'conferences.id as conference_id',
                                'conferences.abbr as conference_abbr'
                            ])
                            ->join('conferences', 'conferences.id', '=', 'teams.conference_id')
                            ->whereIn('conference_id', $this->conferenceIds)
                            ->orderBy('conferences.abbr')
                            ->orderBy('teams.location')
                            ->get();
        }
    }

    public function filters()
    {
        
        $this-> divisions = [];

        array_push($this->divisions, [
            'name' => 'FBS',
            'value' => 'FBS'
        ]);
        array_push($this->divisions, [
            'name' => 'FCS',
            'value' => 'FCS'
        ]);
        array_push($this->divisions, [
            'name' => 'Div II',
            'value' => 'Div II'
        ]);
        array_push($this->divisions, [
            'name' => 'Div III',
            'value' => 'Div III'
        ]);

        $this->conferences = [];
        $this->conferenceIds = [];

        $conferences = Conference::where('division', $this->division)->orderBy('abbr')->get();

        array_push($this->conferences, [
            'name' => 'All',
            'value' => 0
        ]);

        foreach ($conferences as $c) {

            array_push($this->conferences, [
                'name' => $c->abbr,
                'value' => $c->id
            ]);

            array_push($this->conferenceIds, $c->id);

        }

    }

}