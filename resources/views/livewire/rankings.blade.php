<div>

    @slot('title')
        Rankings
    @endslot

    <div class="flex items-end justify-between">

        <div class="flex text-gray-600 tracking-wide font-bold text-xl">
            {{ $poll == 'ap' ? 'AP Poll' : 'Coaches Poll' }} - {{ $period }}</div>

        <div class="flex flex-row items-center space-x-4">
            <div class="flex">
                <x-input.select wire:model.live="poll" :options="$polls" />
            </div>
            <div class="flex">
                <x-input.select wire:model.live="week" :options="$weeks" />
            </div>
        </div>

    </div>

    <!-- rankings -->
    <div class="my-4">

        <div class="flex items-center space-x-4 justify-between text-sm p-2 font-bold">

            <!-- Maatchup Flex -->
            <div class="flex w-2/6">
                Team</a>
            </div>

            <div class="flex w-1/6">
                Record
            </div>

            <div class="flex w-1/6">
                Trend
            </div>
            <div class="flex w-1/6">
                Points
            </div>
            <div class="flex w-1/6">
                Votes
            </div>
        </div>

        <div class="mb-6 bg-white rounded-md shadow-md divide-y divide-gray-200">

            @foreach ($ranks as $rank)

                <div class="flex items-center px-4 space-x-4 justify-between text-sm p-1.5">

                    <!-- Maatchup Flex -->
                    <div class="flex w-2/6 items-center">
                        <div class="font-semibold text-gray-500 mr-4">{{ $rank['rank'] }}</div>
                        <img class="h-5 w-5 mr-2" src="{{ $rank->team->logo }}">
                        <a href="{{ route('team', ['team' => $rank->team->id]) }}"
                            class="hover:text-blue-600 text-md">{{ $rank->team->location }}</a>
                    </div>

                    <div class="flex w-1/6">
                        {{ $rank['record'] }}
                    </div>

                    <div class="flex w-1/6">
                        {{ $rank['trend'] }}
                    </div>
                    <div class="flex w-1/6">
                        {{ $rank['points'] }}
                    </div>
                    <div class="flex w-1/6">
                        {{ $rank['votes'] }}
                    </div>
                </div>

            @endforeach

        </div>

    </div>

</div>