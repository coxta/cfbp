<div>
    @slot('title')
        Scoreboard
    @endslot

    <div class="flex w-full sm:items-end sm:justify-between">

        <div class="hidden sm:flex items-baseline space-x-4">
            <div class="flex text-2xl font-semibold tracking-wider">{{ $period['name'] }}</div>
            <div class="flex text-gray-500">{{ $period['dates'] }}</div>
        </div>

        <div class="flex flex-row flex-grow sm:flex-grow-0 items-center space-x-4">
            <div class="flex flex-grow sm:flex-grow-0">
                <x-input.select wire:model.live="week" :options="$weeks" />
            </div>
            <div class="flex flex-grow sm:flex-grow-0">
                <x-input.select wire:model.live="conference" :options="$conferences" />
            </div>
        </div>

    </div>

    <!-- games -->
    <div class="my-4">
        @foreach ($dates as $date)

            <div class="flex items-center my-3 space-x-4">
                <div class="border-b border-blue-600 flex-grow"></div>
                <div class="text-blue-600 font-normal"> {{ $date['display_date'] }}</div>
                <div class="border-b border-blue-600 flex-grow"></div>
            </div>

            <ul>
            @forelse ($date['games'] as $game)
                <li wire:click="viewGame('{{ $game->id }}')" class="mb-2 my-{{ $game->notes ? '8' : '2' }} bg-white rounded-md shadow-md hover:shadow-xl relative cursor-pointer hover:bg-gray-50">

                    @if ($game->notes)
                        <p class="absolute -top-5 text-gray-500 text-xs pl-1">
                            {{ $game->notes[0]['headline'] }}</p>
                    @endif

                    <div class="flex justify-between space-x-4 py-3 px-2">
                        <div class="{{ $game->status_desc == 'Scheduled' ? 'w-2/3 border-r' : 'w-full md:border-r' }} border-gray-200 md:w-1/3 pl-2 pr-4 space-y-2">
                            <div class="flex items-baseline justify-between">
                                <p class="text-xs text-gray-500 font-semibold">{{ $game->status_detail_short }}</p>
                                @unless($game->completed)
                                    <x-game.network :game="$game" />
                                @endunless
                            </div>
                            <div class="flex flex-col items-start space-y-2">
                                <x-game.away-team :game="$game" />
                                <x-game.home-team :game="$game" />
                            </div>
                        </div>
                        <div class="hidden md:flex items-center w-1/3 pl-4">
                            @if ($game->status_desc == 'Scheduled')
                                <div class="flex flex-col text-gray-500 space-y-2">
                                    <p class="truncate font-medium tracking-tighter">{{ $game->venue['fullName'] }}
                                    </p>
                                    <p class="text-sm font-normal">
                                        {{ $game->venue['address']['city'] . ', ' . $game->venue['address']['state'] }}
                                    </p>
                                </div>
                            @else
                                <div class="flex flex-col divide-y divide-gray-200">

                                    <!-- Box Score -->
                                    <table class="min-w-full ">
                                        <thead class="">
                                            <tr>
                                                <th scope="col"
                                                    class="px-3 py-1.5 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                                    1
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-1.5 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                                    2
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-1.5 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                                    3
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-1.5 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                                    4
                                                </th>
                                                @if (count($game->home_lines) > 4)
                                                    <th scope="col"
                                                        class="px-3 py-1.5 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                                        OT
                                                    </th>
                                                    @for ($p = 2; $p <= count($game->home_lines) - 4; $p++)
                                                        <th scope="col"
                                                            class="px-3 py-1.5 text-left font-bold text-gray-600 text-xs uppercase tracking-wider">
                                                            {{ $p . 'OT' }}
                                                        </th>
                                                    @endfor
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($game->away_lines as $aline)
                                                    <td scope="col"
                                                        class="px-3 py-1.5 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ $aline['value'] }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @foreach ($game->home_lines as $hline)
                                                    <td scope="col"
                                                        class="px-3 py-1.5 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ $hline['value'] }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            @endif
                        </div>

                        <div class="flex items-center pr-4 md:pr-8 w-1/3 {{ $game->status_desc != 'Scheduled' ? 'hidden md:flex' : '' }}">
                            <div class="flex flex-col text-gray-500 w-full items-end space-x-2">
                                @if ($game->status_desc == 'Scheduled')
                                    <x-game.odds :game="$game" />
                                @else
                                    <x-game.leaders :game="$game" />
                                @endif
                            </div>
                        </div>

                    </div>
                </li>

            @empty
                <li><p>No games for the selected period...</p></li>
            @endforelse
            <ul>

        @endforeach
    </div>

</div>