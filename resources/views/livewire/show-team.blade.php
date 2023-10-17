<div>

    @slot('header')
        <div x-cloak x-data="{ compact: false }"
            @scroll.window="window.pageYOffset > 100 ? compact = true : compact = false"
            class="md:flex md:items-center md:justify-evenly md:space-x-5 py-1">
            <div class="flex items-center space-x-6">
                <div class="flex-shrink-0">
                    <img class="transition-all" :class="compact ? 'h-10 w-10' : 'h-20 w-20'" src="{{ $team->logo }}" alt="">
                </div>
                <div class="flex flex-col text-gray-800 uppercase">
                    <div class="transition-all flex flex-col md:flex-row justify-items-start md:items-center md:space-x-2 text-gray-800 uppercase"
                        :class="compact ? 'text-base md:text-xl' : 'text-lg md:text-2xl'">
                        <div class="font-semibold">{{ $team->location }}</div>
                        <div class="font-light text-gray-600">{{ $team->name }}</div>
                    </div>
                    <div x-show="!compact"
                        class="transition-all flex items-center space-x-1 text-sm md:text-base font-light text-gray-500">
                        <div>{{ $team->wins . '-' . $team->losses }}</div>
                        <div>({{ $team->conference_wins . '-' . $team->conference_losses }})</div>
                        {{-- <x-bi-dot class="w-8 h-8" /> --}}
                        <x-heroicon-o-minus-small class="w-8 h-8" />
                        <div>{{ $team->conference_standing }}</div>
                    </div>
                </div>
            </div>
            <div x-show="!compact"
                class="transition-all flex justify-center py-4 md:py-0 px-8 md:px-0">
                <livewire:follow-team :team="$team->id"/>
            </div>
        </div>
    @endslot

    <div class="grid grid-cols-4 gap-4">
        <div class="flex flex-col col-span-4 md:col-span-1">
            <div class="text-gray-500 font-semibold mb-1">Schedule</div>
            <div class="flex flex-col bg-gray-50 rounded-lg shadow-lg divide-y divide-gray-200">
                @foreach ($games as $game)
                    <a href="{{ route('game', ['game' => $game->id]) }}"
                        class="flex items-center justify-between w-full px-3 py-1.5 hover:bg-white">

                        @if ($team->id == $game->home_team)
                            <div class="flex items-center w-2/3 md:w-1/2">
                                <img class="h-6 w-6 mr-4" src="{{ $game->awayTeam->logo }}" />
                                <div class="text-sm text-gray-500 font-semibold">
                                    {{ 'vs ' . ($game->away_rank > 0 && $game->away_rank <= 25 ? $game->away_rank . ' ' : '') . $game->awayTeam->abbreviation }}
                                </div>
                            </div>
                            <div class="flex items-center w-1/3 md:w-1/2 justify-between">
                                @if ($game->completed)
                                    <div
                                        class="text-sm font-bold pl-8 md:pl-4 {{ $game->home_score > $game->away_score ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $game->home_score > $game->away_score ? 'W' : 'L' }}</div>
                                    <div>
                                        {{ $game->home_score > $game->away_score ? $game->home_score . '-' . $game->away_score : $game->away_score . '-' . $game->home_score }}
                                    </div>
                                @else
                                    <div></div>
                                    <div class="text-xs">{{ $game->status_detail_short }}</div>
                                @endif
                            </div>
                        @else
                            <div class="flex items-center w-2/3 md:w-1/2">
                                <img class="h-6 w-6 mr-4" src="{{ $game->homeTeam->logo }}" />
                                <div class="text-sm text-gray-500 font-semibold">
                                    {{ '@ ' . ($game->home_rank > 0 && $game->home_rank <= 25 ? $game->home_rank . ' ' : '') . $game->homeTeam->abbreviation }}
                                </div>
                            </div>
                            <div class="flex items-center w-1/3 md:w-1/2 justify-between">
                                @if ($game->completed)
                                    <div
                                        class="text-sm font-bold pl-8 md:pl-4 {{ $game->away_score > $game->home_score ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $game->away_score > $game->home_score ? 'W' : 'L' }}</div>
                                    <div>
                                        {{ $game->home_score > $game->away_score ? $game->home_score . '-' . $game->away_score : $game->away_score . '-' . $game->home_score }}
                                    </div>
                                @else
                                    <div></div>
                                    <div class="text-xs">{{ $game->status_detail_short }}</div>
                                @endif
                            </div>
                        @endif

                    </a>
                @endforeach
            </div>

        </div>
        <div class="flex flex-col col-span-4 md:col-span-2">
            <div class="text-gray-500 font-semibold mb-1">News</div>

            @foreach ($articles as $article)

                <div class="flex flex-col rounded-lg shadow-xl overflow-hidden mb-4">
                    <div class="flex-shrink-0">
                        @if(isset($article['images'][0]['url']))
                            <img class="w-full object-cover object-top h-60" src="{{ $article['images'][0]['url'] }}"
                            alt="">
                        @endif
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <a href="{{ $article['links']['web']['href'] }}" target="_blank" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">
                                    {{ $article['headline'] }}
                                </p>
                                <p class="mt-3 text-base text-gray-500">
                                    {{ $article['description'] }}
                                </p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center justify-between text-sm text-gray-500 ml-3">
                            <div class="flex">
                                {{ \Carbon\Carbon::parse($article['published'])->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <div class="flex flex-col col-span-4 md:col-span-1">
            <div class="text-gray-500 font-semibold mb-1">Standings</div>

            <div class="text-gray-500 font-semibold mb-1">Stats</div>
            <div class="flex flex-col bg-white rounded-lg shadow-md divide-y divide-gray-200">
                @forelse ($stats as $stat)
                    <div class="flex items-center justify-between px-3 py-1.5">
                        <span>{{ $stat['label'] }}</span>
                        <span class="truncate">{{ $stat['value'] }}</span>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">Team stats unavailable...</p>
                @endforelse
            </div>
        </div>
    </div>

</div>