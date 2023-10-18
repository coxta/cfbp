<div>

    @slot('title')
        Rankings
    @endslot

    <div class="flex items-end justify-between">

        <div class="hidden sm:flex items-baseline space-x-4">
            <div class="flex text-2xl font-semibold tracking-wider text-gray-600">
                {{ $poll == 'cfp' ? 'CFP' : ($poll == 'ap' ? 'AP' : 'Coaches') . ' - ' . $period['name'] }}
            </div>
            <div class="flex text-gray-500">{{ $period['dates'] }}</div>
        </div>

        <div class="flex flex-row flex-grow sm:flex-grow-0 items-end space-x-4">
            @unless($this->week == $this->current && $this->poll == $this->defaultPoll)
                <div class="flex flex-grow sm:flex-grow-0">
                    <x-button action="defaults" icon="arrow-path" color="blue" flat>Reset</x-button>
                </div>
            @endunless
            <div class="flex flex-grow sm:flex-grow-0">
                <x-input.select wire:model.live="poll" :options="$polls" />
            </div>
            <div class="flex flex-grow sm:flex-grow-0">
                <x-input.select wire:model.live="week" :options="$weeks" />
            </div>
        </div>

    </div>

    <!-- rankings -->
    <div class="my-4">

        <div class="flex items-center space-x-4 justify-between text-sm p-2 font-bold">

            <!-- Matchup Flex -->
            <div class="flex w-1/2 md:w-1/3">
                Team
            </div>

            <div class="flex w-1/6 justify-center">
                Record
            </div>

            <div class="flex w-1/6 justify-center">
                Trend
            </div>
            <div class="hidden md:flex w-1/6 justify-center">
                Points
            </div>
            <div class="hidden md:flex w-1/6 justify-center">
                Votes
            </div>
        </div>

        <div class="mb-6 bg-white rounded-md shadow-md divide-y divide-gray-200">

            @foreach ($ranks as $rank)

                <div class="flex items-center px-4 space-x-4 justify-between text-sm p-1.5">

                    <!-- Maatchup Flex -->
                    <div class="flex w-1/2 md:w-1/3 items-center">
                        <div class="font-semibold text-gray-500 mr-4">{{ $rank['rank'] }}</div>
                        <img class="h-5 w-5 mr-2" src="{{ $rank->team->logo }}">
                        <a href="{{ route('team', ['team' => $rank->team->id]) }}"
                            class="hover:text-blue-600 text-md">{{ $rank->team->location }}</a>
                    </div>

                    <div class="flex w-1/6 justify-center">
                        {{ $rank['record'] }}
                    </div>

                    <div class="flex items-center space-x-1 w-1/6 justify-center font-semibold">
                        @if(strlen($rank['trend']) > 1 && substr($rank['trend'],0,1) == '+')
                            <x-bi-arrow-up-short class="w-4 h-4 text-green-600"/>
                            <span class="text-green-600">{{ substr($rank['trend'],1) }}</span>
                        @elseif(strlen($rank['trend']) > 1 && substr($rank['trend'],0,1) == '-')
                            <x-bi-arrow-down-short class="w-4 h-4 text-red-600"/>
                            <span class="text-red-600">{{ substr($rank['trend'],1) }}</span>
                        @else
                            <span class="text-gray-600">{{ $rank['trend'] }}</span>
                        @endif
                    </div>
                    <div class="hidden md:flex w-1/6 justify-center">
                        {{ $rank['points'] }}
                    </div>
                    <div class="hidden md:flex w-1/6 justify-center">
                        {{ $rank['votes'] }}
                    </div>
                </div>

            @endforeach

        </div>

    </div>

</div>