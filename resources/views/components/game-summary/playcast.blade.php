<div class="rounded-lg bg-white shadow px-4 py-3">

    {{-- <h2 class="text-slate-700 font-semibold text-sm pb-2">Playcast</h2> --}}

    @if($drives['current'])

        @if(isset($drives['current']['scoringType']))

            <!-- Current drive just scored -->
            <div class="">
                {{ $current['last']['text'] }}
            </div>

        @else
    
            <!-- Current Drive -->
            <div class="flex flex-row items-center space-x-4 py-2 pb-3 border-b border-gray-300 border-dotted text-sm">

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
                <div class="flex flex-col space-y-3 my-2 text-sm">

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

    @endif

</div>