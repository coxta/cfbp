<div class="flex flex-col w-full py-1 divide-y divide-gray-200">
    @foreach ($game->leaders as $leader)

        <div class="flex flex-row items-center space-x-2 py-0.5">
            <div class="flex text-sm w-1/4">
                {{ $leader['shortDisplayName'] }}
            </div>
            <div class="flex flex-col text-xs w-3/4">
                <div class="flex flex-row space-x-1">
                    <span class="text-gray-700">{{ $leader['leaders'][0]['athlete']['shortName'] }}</span><span
                        class="text-gray-400">{{ $leader['leaders'][0]['athlete']['position']['abbreviation'] . ', ' . ($game->home_team == $leader['leaders'][0]['athlete']['team']['id'] ? $game->homeTeam->abbreviation : $game->awayTeam->abbreviation) }}</span>
                </div>
                <div class="flex flex-row text-gray-800">
                    <span>{{ $leader['leaders'][0]['displayValue'] }}</span>
                </div>
            </div>
        </div>

    @endforeach
</div>