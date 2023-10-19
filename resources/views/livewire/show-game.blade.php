<div>

    @slot('title')
        {{ $game->short_name }}
    @endslot

    @slot('header')
        <x-game.header :game="$game" />
    @endslot

    <!-- Wrapping Grid -->
    <div class="mx-auto grid grid-cols-1 lg:grid-cols-12 gap-2 lg:gap-4">

        <div class="flex flex-col gap-2 order-1 lg:order-2 lg:col-span-6">
            <div class="rounded-lg bg-white shadow px-4 py-3">
                My Contests
                <p class="text-sm my-6">Show the user the results of their contest picks against this game...</p>
            </div>
            <div class="rounded-lg bg-white shadow px-4 py-3 h-48">
                Scoring / Play-by-play
            </div>
        </div>

        <div class="flex flex-col gap-2 order-2 lg:order-1 lg:col-span-3">

            @if($game->status_desc == 'Scheduled')
                <x-game-summary.prediction :game="$summary['prediction']" />
                <x-game-summary.playmakers :game="$summary['leaders']" />
            @else
                <x-game-summary.playmakers :game="$summary['leaders']" />
                <x-game-summary.prediction :game="$summary['prediction']" />
            @endif
            <div class="rounded-lg bg-white shadow px-4 py-3 h-24">
                Win Probabilities
            </div>
            <div class="rounded-lg bg-white shadow px-4 py-3 h-24">
                Team Stats
            </div>
        </div>

        <div class="flex flex-col gap-2 order-3 lg:col-span-3">
            <div class="rounded-lg bg-white shadow px-4 py-3 h-72">
                Conf. Standings
            </div>
        </div>
        
    </div>

</div>
