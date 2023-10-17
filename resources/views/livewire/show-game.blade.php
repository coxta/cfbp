<div>

    @slot('header')
        <x-game.header :game="$game" />
    @endslot

    {{ $game->name }}

</div>