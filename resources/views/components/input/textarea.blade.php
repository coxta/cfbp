@php
    $model = $attributes->wire('model')->value();
@endphp

<div
    @if($attributes->has('disabled'))
        x-data="{ disabled: @entangle($attributes['disabled']).live, chars: 0, max: {{ $attributes['max'] ?? '5000' }}, rows: {{ $attributes['rows'] ?? '3' }} }"
    @else
        x-data="{ disabled: false, chars: 0, max: {{ $attributes['max'] ?? '5000' }}, rows: {{ $attributes['rows'] ?? '3' }} }"
    @endif
    x-init="chars = $refs.input.value.length"
    @change="chars = $refs.input.value.length"
    @input="chars = $refs.input.value.length"
    class="w-full lg:mt-3 {{ $attributes['class'] }} ">

    @if($attributes->has('label'))
        <label for="{{ $model }}" class="relative flex items-center mb-1 text-xs font-medium text-gray-500">
            {{ $attributes['label'] }}
            <span x-show="disabled" class="ml-3 text-grey-400 -mt-0.5"><x-heroicon-s-lock-closed class="inline-block w-3 h-3" /></span>
            <x-elements.loading.spinner wire:target="{{ $model }}" color="text-blue-700" class="w-2 h-2 ml-2" />
            @if($attributes->has('max'))
                <span :class="chars >= max ? 'absolute right-0 text-red-600 text-xxs' : 'absolute right-0 text-gray-400 text-xxs'" >
                    <span x-text="chars"></span><span class="px-0.5">/</span><span x-text="max"></span>
                </span>
            @endif
        </label>
    @endif

    <textarea
        x-ref="input"
        :rows="rows"
        id="{{ $model }}"
        name="{{ $model }}"
        :maxlength="max"
        {{ $attributes->wire('model') }}
        :disabled="disabled"
        placeholder="{{ $attributes['placeholder'] }}"
        :class="{ 'bg-transparent pointer-events-none' : disabled }"
        class="block w-full border-gray-300 rounded-md shadow focus:outline-none text-sm
            @error($model)
                {{ 'text-red-600 border-red-500 focus:ring-1 focus:ring-red-400 focus:border-red-400' }}
            @else
                {{ 'focus:ring-1 focus:ring-blue-700 focus:border-blue-700' }}
            @enderror
            "
        ></textarea>

        @error($model)
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror

</div>