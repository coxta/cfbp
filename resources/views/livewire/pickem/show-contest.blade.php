<div>

    <h2 class="font-bold text-2xl leading-6 text-gray-900">
        {{ $contest->group->name == 'Master' ? 'Open Public Contest' : 'Group Contest: ' . $contest->group->name }}
    </h2>

    <h3 class="font-semibold leading-6 text-gray-700 mt-3">{{ $contest->name }}</h3>

    @if($contest->status == 'Submitted')

        <h3 class="text-sm text-gray-700 my-2">Entries</h3>
        <p>Working on it...</p>

    @elseif(count($contest->selections) == 12 && $contest->status == 'Created')

        <div class="flex flex-row items-center justify-around">
            <x-button label="View Selections" x-on:click="$openModal('contest-selections')" sm primary />
            <x-button wire:click="submit" positive label="Submit Selections" />
        </div>

    @elseif($contest->status == 'Created')
        
        <x-modal name="contest-selections" blur="sm">
            <x-card title="Contest Selections" class="w-full max-w-2xl">
                <h3 class="mb-2">Current Selections</h3>
                <div class="flex flex-col space-y-1">

                    @foreach($contest->selections as $selection)

                        <div class="flex flex-row items-center justify-between">
                            <div>{{ $selection->game->short_name }}</div>
                            <div class="flex flex-row items-center space-x-4 justify-end">
                                <div>{{ $selection->favorite->abbreviation }} -{{ $selection->spread }}</div>
                                <x-button wire:click="dropSelection('{{ $selection->game->id }}')" outline xs negative label="Remove" />
                            </div>
                        </div>

                    @endforeach

                </div>
            </x-card>
        </x-modal>

        <div class="flex w-full sm:items-end sm:justify-between">
    
            <div class="hidden sm:flex items-baseline space-x-4">
                <div class="flex text-sm">
                    {{ $contest->week->name }} available games
                </div>
            </div>
    
            <div class="flex flex-row items-end space-x-4">

                @if(count($contest->selections) > 0)
                    <div class="flex">
                        <x-button label="View Selections" x-on:click="$openModal('contest-selections')" sm primary />
                    </div>
                @endif

                <div class="flex">
                    <x-native-select 
                        wire:model.live="conference"
                        :options="$conferences" 
                        option-label="name" 
                        option-value="value" />
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
                    <li wire:click="selection('{{ $game->id }}')" class="mb-2 my-{{ $game->notes ? '8' : '2' }} bg-white rounded-md shadow-md hover:shadow-xl relative cursor-pointer hover:bg-gray-50">
    
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
                                                            {{ $aline['value'] ?? ($aline['displayValue'] ?? '-') }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($game->home_lines as $hline)
                                                        <td scope="col"
                                                            class="px-3 py-1.5 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                                            {{ $hline['value'] ?? ($hline['displayValue'] ?? '-') }}
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

    @else

        <p>Contest selections have been made...users can submit entries...</p>
        
    @endif

</div>
