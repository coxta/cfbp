<div class="flex w-full justify-between">
    @if ($game->awayTeam)
        <div class="flex flex-row items-center">

            <img class="h-7 w-7 mr-2" src="{{ $game->awayTeam->logo }}">

            <div class="flex flex-col">

                <div class="flex flex-row items-baseline font-bold">
                    @if ($game->away_rank <= 25)
                        <span class="text-sm text-gray-500 font-medium mr-1.5">{{ $game->away_rank }}</span>
                    @endif
                    @if (($game->completed && $game->away_score < $game->home_score) || $game->away_team == 0)
                        <a href="{{ route('team', ['team' => $game->awayTeam->id]) }}"
                            class="text-gray-400 hover:text-blue-600 font-bold text-lg">{{ $game->awayTeam->location }}</a>
                    @else
                        <a href="{{ route('team', ['team' => $game->awayTeam->id]) }}"
                            class="text-gray-700 hover:text-blue-600 font-bold text-lg">{{ $game->awayTeam->location }}</a>
                    @endif
                </div>

                @if(isset($game->away_records))
                    <div class="flex text-xs text-gray-500 p-0 font-extralight">
                        @foreach ($game->away_records as $rec)
                            @if ($rec['type'] == 'total')
                                {{ '(' . $rec['summary'] }}
                            @endif
                            @if ($rec['type'] == 'vsconf')
                                {{ ', ' . $rec['summary'] . ' ' . $game->awayConference->abbr . ')' }}
                            @endif
                        @endforeach
                    </div>
                @endif

            </div>

        </div>
        @if ($game->completed && $game->away_score < $game->home_score)
            <div class="flex font-bold text-gray-400 text-right text-lg">{{ $game->away_score }}</div>
        @elseif ($game->status_desc != 'Scheduled')
            <div class="flex font-bold text-gray-700 text-right text-lg">{{ $game->away_score }}</div>
        @endif

    @else
        TBD
    @endif
</div>