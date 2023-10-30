<div class="rounded-lg bg-white shadow px-4 py-3">

    @if(isset($drives['current']))

        @if(isset($drives['current']['scoringType']))

            <!-- Current drive just scored -->
            <div class="">
                {{ $current['last']['text'] }}
            </div>

        @else
    
            <!-- Current Drive -->
            <div class="flex flex-row items-center space-x-4 py-2 pb-3 border-b border-gray-300 border-dotted text-xs">

                <!-- Down -->
                <div class="flex flex-row items-center space-x-2">
                    <div class="text-gray-500 font-semibold uppercase">
                        DOWN:
                    </div>
                    <div class="text-gray-900 font-bold">
                        {{ $current['down'] }}
                    </div>
                    <div class="text-gray-500 font-semibold uppercase">
                        BALL ON:
                    </div>
                    <div class="text-gray-900 font-bold">
                        {{ $current['yardline'] }}
                    </div>
                    <div class="text-gray-500 font-semibold uppercase">
                        DRIVE:
                    </div>
                    <div class="text-gray-900 font-bold">
                        {{ $current['summary'] }}
                    </div>
                </div>

            </div>

            @if(isset($current['last']['start']['downDistanceText']))
                <!-- Last Play -->
                <div class="flex flex-col space-y-0.5 py-2 text-xs border-b border-gray-300 border-dotted">

                    <div class="flex flex-row items-center space-x-2">
                        <div class="text-gray-500 font-semibold uppercase">
                            LAST PLAY:
                        </div>
                        <div class="text-gray-900 font-bold">
                            {{ $current['last']['start']['downDistanceText'] }}
                        </div>
                    </div>

                    <div class="">
                        {{ $current['last']['text'] }}
                    </div>

                </div>
            @endif

        @endif

        @if(count($current['plays']) > 0)

            <div class="flex flex-col">

                <h3 class="py-2 mt-2 text-xs text-center font-bold text-gray-400 uppercase">Current Drive</h3>
        
                @foreach(array_reverse($current['plays']) as $play)

                    @if(isset($play['start']['downDistanceText']) && isset($play['text']))

                        @php
                            switch ($play['period']['number']) {
                                case 1:
                                    $q = '1st';
                                    break;
                                case 2:
                                    $q = '2nd';
                                    break;
                                case 3:
                                    $q = '3rd';
                                    break;
                                default:
                                    $q = '4th';
                                    break;
                            }
                        @endphp

                        <div class="flex flex-col space-y-1 py-2 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
                            <div class="text-xs text-gray-900 font-bold">
                                {{ $play['start']['downDistanceText'] ?? null }}
                            </div>
                            <div class="text-xs text-gray-600">
                                {{ '(' . $play['clock']['displayValue'] . ' - ' . $q . ') ' . $play['text'] ?? null }}
                            </div>
                        </div>
                    @endif

                @endforeach
            
            </div>

        @endif

    @endif

    @if(isset($drives['previous']))

        <div x-data="{ tab: 'scoring' }">

            <div class="flex flex-col items-center mb-2">
                <div class="flex-1 isolate inline-flex rounded-md shadow-sm">
                    <button 
                        x-on:click="tab = 'scoring'" 
                        type="button" 
                        :class="tab == 'scoring' ? 'relative inline-flex items-center rounded-l-md bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10' : 'relative inline-flex items-center rounded-l-md bg-white px-3 py-1.5 text-xs font-normal text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10'"
                        >Scoring Summary</button>
                        <button 
                        x-on:click="tab = 'plays'" 
                        type="button" 
                        :class="tab == 'plays' ? 'relative inline-flex items-center -ml-px rounded-r-md bg-gray-100 px-3 py-1.5 text-xs font-bold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10' : 'relative inline-flex items-center -ml-px rounded-r-md bg-white px-3 py-1.5 text-xs font-normal text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10'"
                        >Play-by-Play</button>
                </div>
            </div>
            
            @if(isset($scoring) && count($scoring) > 0)

                <div x-show="tab == 'scoring'" x-cloak>

                    @php 
                        $period = 0;
                    @endphp

                    @foreach($scoring as $score)
                        
                        @if($score['period']['number'] != $period)
                            @php
                                switch ($score['period']['number']) {
                                    case 1:
                                        $qtr = '1st Quarter';
                                        break;
                                    case 2:
                                        $qtr = '2nd Quarter';
                                        break;
                                    case 3:
                                        $qtr = '3rd Quarter';
                                        break;
                                    default:
                                        $qtr = '4th Quarter';
                                        break;
                                }
                                $period = $score['period']['number'];
                            @endphp
                            
                            <div class="flex flex-row items-start text-xs py-1 font-bold text-gray-900 uppercase">
                                <div class="w-10/12">{{ $qtr }}</div>
                                <div class="w-2/12 flex flex-row items-start space-x-4 text-right">
                                    <div class="w-1/2">{{ $away->abbreviation }}</div>
                                    <div class="w-1/2">{{ $home->abbreviation }}</div>
                                </div>
                            </div>
                        @endif

                            <div class="flex flex-row items-start text-xs py-2 text-gray-900">
                                <div class="w-10/12 flex flex-row items-start space-x-2 tracking-tighter">
                                    <img src="{{ $score['team']['logo'] }}" class="w-4 h-4"/>
                                    <div>{{ $score['type']['abbreviation'] }}</div>
                                    <div>{{ $score['clock']['displayValue'] }}</div>
                                    <div>{{ $score['text'] }}</div>
                                </div>
                                <div class="w-2/12 flex flex-row items-start space-x-4 text-right">
                                    <div class="w-1/2">{{ $score['awayScore'] }}</div>
                                    <div class="w-1/2">{{ $score['homeScore'] }}</div>
                                </div>
                            </div>

                    @endforeach

                </div>
            @endif

            <!-- Previous Drives -->
            <div  x-show="tab == 'plays'" x-cloak class="flex flex-col divide-y divide-gray-300">

                @foreach($drives['previous'] as $drive)

                    @if($drive['offensivePlays'] > 0)
                        <div x-data="{ open: false }" class="flex flex-col">
                            <div x-on:click="open = ! open" class="flex flex-row items-center space-x-4 my-2 cursor-pointer">
                                <x-heroicon-s-chevron-right x-show="open == false" class="w-4 h-4 text-gray-700" />
                                <x-heroicon-s-chevron-down x-show="open" class="w-4 h-4 text-gray-700" />
                                <img src="{{ $drive['team']['logos'][0]['href'] }}" class="w-6 h-6"/>
                                <div class="flex flex-col text-xs">
                                    <div class="font-semibold text-gray-900 uppercase">
                                        {{ $drive['displayResult'] ?? $drive['description'] }}
                                    </div>
                                    <div class="font-normal text-gray-700">
                                        {{ $drive['description'] }}
                                    </div>
                                </div>
                            </div>
                            <div x-show="open" x-transition x-cloak>

                                @foreach($drive['plays'] as $play)

                                    @if(isset($play['start']['downDistanceText']) && isset($play['text']))

                                        @php
                                            switch ($play['period']['number']) {
                                                case 1:
                                                    $q = '1st';
                                                    break;
                                                case 2:
                                                    $q = '2nd';
                                                    break;
                                                case 3:
                                                    $q = '3rd';
                                                    break;
                                                default:
                                                    $q = '4th';
                                                    break;
                                            }
                                        @endphp

                                        <div class="flex flex-col space-y-1 py-2 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
                                            <div class="text-xs text-gray-900 font-bold">
                                                {{ $play['start']['downDistanceText'] ?? null }}
                                            </div>
                                            <div class="text-xs text-gray-600">
                                                {{ '(' . $play['clock']['displayValue'] . ' - ' . $q . ') ' . $play['text'] ?? null }}
                                            </div>
                                        </div>
                                    @else

                                        <div class="flex flex-col py-1 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
                                            <div class="text-xs text-gray-900 font-bold">
                                                {{ $play['text'] ?? null }}
                                            </div>
                                        </div>

                                    @endif

                                @endforeach

                            </div>
                        </div>
                    @endif

                @endforeach
            
            </div>
        </div>
    @endif

</div>