<div class="rounded-lg bg-white shadow px-4 py-3">

    @if($drives['current'])

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

</div>