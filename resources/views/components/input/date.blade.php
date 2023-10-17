@php
    $model = $attributes->wire('model')->value();
@endphp

<div
    @if($attributes->has('disabled'))
    x-data="{ value: @entangle($attributes->wire('model')).live, disabled: @entangle($attributes['disabled']).live}"
    @else
    x-data="{ value: @entangle($attributes->wire('model')).live, disabled: false }"
    @endif
    x-init="[ d = $refs.input.value,
              y = new Date().getFullYear(),
              p = new Pikaday({ field: $refs.input, yearRange: [y - 100, y], format: 'MM/DD/YYYY' }),
              d ? p.setDate(Moment(d, 'l')) : false
            ]"
    x-on:change="value = $event.target.value"
    class="w-full lg:mt-3 {{ $attributes['class'] }}">

    @if($attributes->has('label'))
        <label for="{{ $model }}" class="flex items-center mb-1 text-xs font-medium text-gray-500">
            {{ $attributes['label'] }}
            <span x-show="!disabled" class="ml-1 text-gray-400 text-xxs ">( mm/dd/yyyy )</span>
            <span x-show="disabled" class="ml-3 text-grey-400 -mt-0.5"><x-heroicon-s-lock-closed class="inline-block w-3 h-3" /></span>
            <x-elements.loading.spinner wire:target="{{ $model }}" color="text-blue-700" class="w-2 h-2 ml-2" />
        </label>
    @endif

    <input
        type="text"
        x-ref="input"
        id="{{ $model }}"
        name="{{ $model }}"
        {{ $attributes->wire('model') }}
        x-bind:disabled="disabled"
        :class="{ 'bg-transparent pointer-events-none' : disabled }"
        class="block w-full border-gray-300 rounded-md shadow focus:outline-none text-sm
            @error($model)
                {{ 'text-red-600 border-red-500 focus:ring-1 focus:ring-red-400 focus:border-red-400' }}
            @else
                {{ 'focus:ring-1 focus:ring-blue-700 focus:border-blue-700' }}
            @enderror
            "
        />
    @error($model)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror

</div>