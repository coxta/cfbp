<div>

    @slot('title')
        Schedule
    @endslot

    <div class="flex items-end justify-between">

        <div class="flex text-gray-600 tracking-wide font-bold text-xl">{{ $period }}</div>

        <div class="flex flex-row items-center space-x-4">
            <div class="flex">
                <x-input.select wire:model.live="week" :options="$weeks" />
            </div>
            <div class="flex">
                <x-input.select wire:model.live="conference" :options="$conferences" />
            </div>
        </div>

    </div>

    <!-- games -->
    <div class="my-4">
        @foreach ($dates as $date)

            <div class="text-gray-900 font-semibold text-normal mb-2">{{ $date['display_date'] }}</div>

            <div class="mb-6 bg-white rounded-md shadow-md">

                @forelse ($date['games'] as $game)

                    <div class="p-2.5 border-b border-gray-200">

                        {{-- @if ($game->notes)
                            <div class="text-xs text-gray-600 mb-1 font-light">
                                {{ $game->notes[0]['headline'] }}
                            </div>
                        @endif --}}

                        <div class="flex items-center space-x-4 justify-between text-sm">

                            <!-- Maatchup Flex -->
                            <div class="flex w-3/5">
                                <div class="flex items-center space-x-4 w-full">
                                    <div class="w-2/5">
                                        <x-game.away-team :game="$game"/>
                                    </div>
                                    <div class="w-3/5">
                                        <x-game.home-team :game="$game"/>
                                    </div>
                                </div>
                            </div>

                            <div class="flex w-1/5">
                                @if ($game->completed)
                                    {{ $game->status_detail_short }}
                                @elseif($game->status_desc == 'Scheduled')
                                    {{ $game->status_detail_short }}
                                @else
                                    {{ $game->status_detail_short }}
                                @endif
                            </div>

                            <div class="flex w-1/5">
                                @if ($game->completed)
                                    <a href="{{ route('game', ['game' => $game->id]) }}"
                                        class="text-sm text-blue-600 hover:font-bold">{{ $game->awayTeam->abbreviation . ' ' . $game->away_score . ', ' . $game->homeTeam->abbreviation . ' ' . $game->home_score }}</a>
                                @elseif($game->status_desc == 'Scheduled')
                                    <x-game.odds :game="$game" />
                                @else
                                    {{ $game->status_detail_short }}
                                @endif
                            </div>
                            {{-- <div class="flex w-1/5">
                                @if ($game->completed)
                                    Attendance: {{ $game->attendance > 0 ? $game->attendance : 'Unknown' }}
                                @else
                                    <x-game.network :game="$game" />
                                @endif
                            </div> --}}
                        </div>
                    </div>

                @empty
                    <p>No games for the selected period...</p>
                @endforelse
            </div>

        @endforeach
    </div>

</div>