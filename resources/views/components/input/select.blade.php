@php
    $model = $attributes->wire('model')->value();
@endphp
<div
    @if($attributes->has('disabled'))
    x-data="{ value: @entangle($attributes->wire('model')).live, disabled: @entangle($attributes['disabled']).live}"
    @else
    x-data="{ value: @entangle($attributes->wire('model')).live, disabled: false }"
    @endif
    x-on:change="value = $event.target.value"
    class="w-full lg:mt-3 {{ $attributes['class'] }}">

    @if($attributes->has('label'))
        <label for="{{ $model }}" class="flex items-center mb-1 text-xs font-medium text-gray-500">
            {{ $attributes['label'] }}
            <span x-show="disabled" class="ml-3 text-grey-400 -mt-0.5"><x-heroicon-s-lock-closed class="inline-block w-3 h-3" /></span>
            <x-loader :action="$model" color="text-blue-700" class="w-2 h-2 ml-2" />
        </label>
    @endif

    <select
        id="{{ $model }}"
        name="{{ $model }}"
        x-bind:disabled="disabled"
        {{ $attributes->wire('model') }}
        :class="{ 'bg-transparent pointer-events-none' : disabled }"
        class="block w-full mt-1 border-gray-300 rounded-md shadow text-sm
        @error($model)
                {{ 'text-red-600 border-red-500 focus:ring-1 focus:ring-red-400 focus:border-red-400' }}
            @else
                {{ 'focus:ring-1 focus:ring-blue-700 focus:border-blue-700' }}
            @enderror
            "
        />
            <option x-show="typeof value !== 'undefined' && !value" value="--select--">Select...</option>
        @foreach ($options as $key => $option)
            <option value="{{ $option['value'] }}">{{ $option['name'] }}</option>
        @endforeach
    </select>

    @error($model)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror

</div>