<div @if(in_array($game->status_desc, ['In Progress','End of Period','Halftime'])) wire:poll.15s @endif>

    @slot('title')
        {{ $game->short_name }}
    @endslot

    @slot('header')
        <x-game.header :game="$game" />
    @endslot

    <!-- Wrapping Grid -->
    <div class="mx-auto grid grid-cols-1 lg:grid-cols-12 gap-2 lg:gap-4">

        <div class="flex flex-col gap-2 order-3 lg:order-2 lg:col-span-6">

            @unless($game->status_desc == 'Scheduled')
                <x-game-summary.playcast :drives="$summary['drives']" :scoring="$summary['scoring']" :home="$game->homeTeam" :away="$game->awayTeam"/>
            @endunless

            <x-game-summary.game-articles :article="$summary['article']" :stories="$summary['news']" />

        </div>

        <div class="flex flex-col gap-2 order-1 lg:col-span-3">

            <x-game-summary.venue :venue="$summary['venue']" />

            @if($game->status_desc == 'Scheduled')
                <x-game-summary.prediction wire:ignore :game="$summary['prediction']" />
                <x-game-summary.playmakers :game="$summary['leaders']" />
            @else
                <x-game-summary.playmakers :game="$summary['leaders']" />
                <x-game-summary.prediction wire:ignore :game="$summary['prediction']" />
            @endif

            <x-game-summary.probability :game="$summary['probability']" />

        </div>

        <div class="flex flex-col gap-2 order-2 lg:order-3 lg:col-span-3">

            <x-game-summary.game-contests :game="$game->id" />

            @foreach ($summary['standings']['groups'] as $conference)
                <x-game-summary.conference-standings :conference="$conference" :teams="$game->teams" />
            @endforeach

            <x-game-summary.team-stats :game="$summary['boxscore']" />

        </div>
        
    </div>

</div>
