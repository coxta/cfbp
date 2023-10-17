@php
    $model = $attributes->wire('model')->value();
@endphp

<div
    @if($attributes->has('disabled'))
    x-data="{ disabled: @entangle($attributes['disabled']).live}"
    @else
    x-data="{ disabled: false }"
    @endif
    class="w-full lg:mt-3 {{ $attributes['class'] }} ">

    <div x-data="{ files: null, thumbnail: @entangle($model).live }" class="relative w-full">

    @if($attributes->has('label'))
        <label for="{{ $model }}" class="flex items-center mb-1 text-xs font-medium text-gray-500">
            {{ $attributes['label'] }}
            <span x-show="disabled" class="ml-3 text-grey-400 -mt-0.5"><x-heroicon-s-lock-closed class="inline-block w-3 h-3" /></span>
            <x-elements.loading.spinner wire:target="{{ $model }}" color="text-blue-700" class="w-2 h-2 ml-2" />
        </label>
    @endif

    <input
        @if($attributes->has('type') && ($attributes['type'] == 'email' || $attributes['type'] == 'password' || $attributes['type'] == 'tel'))
            type="{{ $attributes['type'] }}"
        @else
            type="text"
        @endif
        id="{{ $model }}"
        name="{{ $model }}"
        {{ $attributes->wire('model') }}
        x-bind:disabled="disabled"
        x-model="thumbnail"
        placeholder="{{ $attributes['placeholder'] }}"
        :class="{ 'bg-transparent pointer-events-none' : disabled, 'pl-16' : thumbnail }"
        class="block w-full border-gray-300 rounded-md shadow focus:outline-none text-sm
            @error($model)
                {{ 'text-red-600 border-red-500 focus:ring-1 focus:ring-red-400 focus:border-red-400' }}
            @else
                {{ 'focus:ring-1 focus:ring-blue-700 focus:border-blue-700' }}
            @enderror
            "
        />

        <img x-show="thumbnail" class="absolute rounded-sm h-7 left-2.5 top-6" x-bind:src="thumbnail">

        <input type="file" x-ref="fileUpload" {{ $attributes->wire('model') }} class="sr-only" x-on:change="files = Object.values($event.target.files)">

        @error($model)
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
        <x-button x-on:click="$refs.fileUpload.click()" size="xs" icon="cloud-upload" class="absolute right-2 top-7">Upload</x-button>

        </div>
</div>