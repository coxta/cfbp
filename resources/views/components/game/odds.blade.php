<div class="flex flex-col w-full items-center md:justify-end md:flex-row md:items-center md:space-x-2">
    @if($game->favorite && $game->spread)
        <img class="h-12 w-12 md:h-8 md:w-8 mb-2 md:mb-0" src="{{ $game->favorite->logo }}">
        <span>{{ $game->odds }}</span>
    @else
        <span>Line: N/A</span>
    @endif
</div>