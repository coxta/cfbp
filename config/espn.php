<?php

return [

    /*
    |--------------------------------------------------------------------------
    | ESPN API Endpoints
    |--------------------------------------------------------------------------
    */
    'season' => 2023,

    'games' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/scoreboard?limit=1000',
    'conferences' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/scoreboard/conferences?limit=1000&groups=80,81,57,58,35,99',
    'divisions' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/scoreboard/conferences?groups=',
    'teams' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/teams?limit=1000',
    'fbs-teams' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/teams?limit=1000&groups=80',
    'fcs-teams' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/teams?limit=1000&groups=81',
    'team' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/teams/',
    'rankings' => 'https://site.api.espn.com/apis/site/v2/sports/football/college-football/rankings',
    'news' => 'http://site.api.espn.com/apis/site/v2/sports/football/college-football/news?limit=1000',
    'team-news' => 'http://site.api.espn.com/apis/site/v2/sports/football/college-football/news?limit=1000&team=',
];