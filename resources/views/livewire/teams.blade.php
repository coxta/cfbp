<div>

    @slot('title')
        Teams
    @endslot

    <div class="flex flex-col space-y-1 md:space-y-0 md:flex-row md:items-center md:space-x-4 md:justify-between">
        <div class="flex text-md font-semibold text-gray-700">
            Teams
        </div>
        <div class="flex flex-row items-center space-x-4">
            <x-input.select wire:model.live="division" :options="$divisions" />
            <x-input.select wire:model.live="conference" :options="$conferences" />
        </div>
    </div>

    <div class="bg-white rounded-md shadow-md my-4 p-4">

        @php 
            $conf = 0;
        @endphp

        @foreach($teams as $team)

            @if($team->conference_id != $conf)
                @php 
                    $conf = $team->conference_id;
                @endphp
                <div class="text-gray-700 font-bold text-sm py-2.5 mb-2 border-b border-dotted border-gray-700">
                    {{ $team->conference_abbr }}
                </div>
            @endif
                <a href="/teams/{{ $team->id }}" class="flex flex-row ml-2 items-center space-x-4 py-1 cursor-pointer text-gray-800 hover:text-blue-800 {{ $loop->last ? '' : 'border-b border-gray-200' }}">
                    <img src="{{ $team->logo }}" class="w-8 h-8" />
                    <span class="font-bold">
                        {{ $team->location . ' ' . $team->name }}
                    </span>
                </a>
        @endforeach

    </div>

</div>