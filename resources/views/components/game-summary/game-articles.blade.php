<div>

    @if(isset($headline))
    <div class="flex flex-col bg-white rounded-lg shadow overflow-hidden mb-4 p-6 justify-between">
        <div class="flex-1">
            <p class="text-lg font-semibold text-gray-900">
                {{ $headline }}
            </p>
            {{-- <p class="mt-3 text-sm text-gray-500">
                {{ $description }}s
            </p> --}}
        </div>
        <div class="mt-6 text-xs text-gray-700 game-story">
            {!! $story !!}
        </div>
    </div>
    @endif
    
    @foreach ($stories as $story)

        <div class="flex flex-col rounded-lg shadow overflow-hidden mb-4">
            <div class="flex-shrink-0">
                <img class="w-full object-cover object-top h-60" src="{{ $story['images'][0]['url'] }}" alt="">
            </div>
            <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                <div class="flex-1">
                    <a href="{{ $story['links']['web']['href'] }}" target="_blank" class="block mt-2">
                        <p class="text-xl font-semibold text-gray-900">
                            {{ $story['headline'] }}
                        </p>
                        <p class="mt-3 text-base text-gray-500">
                            {{ $story['description'] }}s
                        </p>
                    </a>
                </div>
                <div class="mt-6 flex items-center">

                    <div class="ml-3">
                        <div class="flex space-x-1 text-sm text-gray-500">
                            {{ $story['published'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

</div>