<template>
    @if (isset($teams) && count($teams) > 0)
        @foreach ($teams as $team)
            <li class="pl-2.5">
                <a href="{{ route('team', $team->id) }}"
                    class="flex flex-row cursor-pointer hover:font-semibold items-center text-dark gap-x-3 p-2 text-sm">
                    <x-bi-arrow-return-right class="w-4 h-4 text-muted" />
                    <img src="{{ $team->logo }}" class="h-4 w-4" />
                    {{ $team->abbreviation }}
                </a>
            </li>
        @endforeach
    @endif
</template>
