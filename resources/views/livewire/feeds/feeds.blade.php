<div x-data="{ upserting: @entangle('upserting').live }">

    @slot('title')
        Feeds
    @endslot

    <div x-show="!upserting">
        <div class="flex items-center justify-between">
            <div class="flex text-xl font-semibold text-gray-500">Current Feeds</div>
            <div class="flex">
                <x-button primary wire:click="$toggle('upserting')" label="New" />
            </div>
        </div>

        <div class="bg-white shadow-md border border-gray-200 overflow-hidden sm:rounded-md mt-4">
            <ul role="list" class="divide-y divide-gray-200">

                @foreach ($feeds as $f)

                    <li>
                    <a href="{{ route('feed', ['feed' => $f->id]) }}" class="block hover:bg-gray-50 py-2">
                            <div class="flex items-center justify-between py-1 px-4">
                                <p class="text-lg font-semibold text-blue-600 truncate">{{ $f->name }}</p>
                                <p class="flex items-center text-sm text-gray-500">
                                    <x-heroicon-o-folder class="h-4 w-4 mr-2" />
                                    <span class="truncate">{{ $f->job }}</span>
                                </p>
                            </div>
                            <div class="flex items-center justify-between py-1 px-4">
                                <p class="text-sm text-gray-900">{{ $f->description }}</p>
                                <p class="flex items-center text-sm text-gray-500">
                                    <x-heroicon-o-clock class="h-4 w-4 mr-2" />
                                    {{ $f->frequency }}
                                </p>
                            </div>
                        </a>
                    </li>

                @endforeach

            </ul>
        </div>


    </div>

    <div x-show="upserting">
        <div class="text-xl font-semibold tracking-wide">New Feed</div>
        <div class="mt-4">

            <x-input wire:model.blur="feed.name" label="Name" placeholder="Scoreboard"/>          
            <x-input wire:model.blur="feed.description" label="Description" placeholder="Polls the ESPN Scoreboard API for updates" />
            <x-input wire:model.blur="feed.job" label="Job" placeholder="App\Jobs\Feeds\Scoreboard" />
            <x-input wire:model.blur="feed.frequency" label="Frequency" placeholder="Every 5 Minutes" />

            <div class="flex justify-center space-x-4 my-4">
                <x-button negative outline wire:click="$toggle('upserting')" label="Cancel" />
                <x-button primary wire:click="save" icon="circle-stack" label="Save" />
            </div>

        </div>
    </div>

</div>