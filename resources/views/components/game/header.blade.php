<div>
    @if ($game->notes)
        <div class="text-center text-xs border-b border-gray-200 text-gray-600 py-1.5">
            {{ $game->notes[0]['headline'] }}</div>
    @endif
    <div class="flex items-center space-x-4 py-2">

        <!-- Away Team -->
        <div class="flex items-center justify-end w-1/3 md:w-5/12 text-lg text-gray-900 font-bold">
            <div class="flex flex-col items-end">
                <div class="flex items-center">
                    @if ($game->away_rank <= 25)
                        <span class="text-sm text-gray-500 font-medium mr-1.5">{{ $game->away_rank }}</span>
                    @endif
                    @if ($game->away_team > 0)
                        <span class="hidden md:flex">{{ $game->awayTeam->location . ' ' . $game->awayTeam->name }}</span>
                        <span class="flex md:hidden">{{ $game->awayTeam->abbreviation }}</span>
                    @else
                        <span class="text-gray-500">TBD</span>
                    @endif
                </div>

                @if(isset($game->away_records))
                    <div class=" text-sm text-gray-600 p-0 font-light">
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
            @if($game->status_desc != 'Scheduled')
                <div class="px-3 md:px-6">
                    <img src="{{ $game->awayTeam->logo }}" alt="{{ $game->awayTeam->abbreviation }}"
                        class="w-12 h-12" />
                </div>
                <div class="text-3xl md:text-4xl font-bold">
                    @if ($game->completed && $game->away_score < $game->home_score)
                        <span class="text-gray-400">{{ $game->away_score }}</span>
                    @else
                        <span class="text-gray-700">{{ $game->away_score }}</span>
                    @endif
                </div>
            @else
                <div class="pl-3 md:pl-6">
                    <img src="{{ $game->awayTeam->logo }}" alt="{{ $game->awayTeam->abbreviation }}"
                        class="w-12 h-12" />
                </div>
            @endif
        </div>

        <!-- Status -->
        <div class="w-1/3 md:w-2/12 flex flex-col items-center space-y-2 text-xs md:text-sm text-gray-600">
            <div class="font-bold">{{ $game->status_detail_short }}</div>
            @if(!$game->completed)
                @foreach ($game->broadcasts as $b)
                    @if (isset($b['names']))
                        <x-network :network="$b['names'][0]" />
                    @endif
                @endforeach
            @endif
        </div>

        <!-- Home Team -->
        <div class="flex items-center justify-start w-1/3 md:w-5/12 text-lg text-gray-900 font-bold">

            @if($game->status_desc != 'Scheduled')
                <div class="text-3xl md:text-4xl font-bold">
                    @if ($game->completed && $game->home_score < $game->away_score)
                        <span class="text-gray-400">{{ $game->home_score }}</span>
                    @else
                        <span class="text-gray-700">{{ $game->home_score }}</span>
                    @endif
                </div>
                <div class="px-3 md:px-6">
                    <img src="{{ $game->homeTeam->logo }}" alt="{{ $game->homeTeam->abbreviation }}"
                        class="w-12 h-12" />
                </div>
            @else
                <div class="pr-3 md:pr-6">
                    <img src="{{ $game->homeTeam->logo }}" alt="{{ $game->homeTeam->abbreviation }}"
                        class="w-12 h-12" />
                </div>
            @endif

            <div class="flex flex-col items-start">

                <div class="flex items-center">
                    @if ($game->home_rank <= 25)
                        <span class="text-sm text-gray-500 font-medium mr-1.5">{{ $game->home_rank }}</span>
                    @endif
                    @if ($game->home_team > 0)
                        <span class="hidden md:flex">{{ $game->homeTeam->location . ' ' . $game->homeTeam->name }}</span>
                        <span class="flex md:hidden">{{ $game->homeTeam->abbreviation }}</span>
                    @else
                        <span class="text-gray-500">TBD</span>
                    @endif
                </div>

                @if(isset($game->home_records))
                    <div class=" text-sm text-gray-600 p-0 font-light">
                        @foreach ($game->home_records as $rec)
                            @if ($rec['type'] == 'total')
                                {{ '(' . $rec['summary'] }}
                            @endif
                            @if ($rec['type'] == 'vsconf')
                                {{ ', ' . $rec['summary'] . ' ' . $game->homeConference->abbr . ')' }}
                            @endif
                        @endforeach
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>