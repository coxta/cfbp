@php
    $model = $attributes->wire('model')->value();
    $cols = $attributes['columns'] ?? '3';
@endphp
<div
    @if($attributes->has('disabled'))
    x-data="{ disabled: @entangle($attributes['disabled']).live}"
    @else
    x-data="{ disabled: false }"
    @endif
    class="w-full lg:mt-1 {{ $attributes['class'] }} ">
    @if($attributes->has('label'))
        <label for="{{ $model }}" class="flex items-center mb-1 text-xs font-medium text-gray-500">
            {{ $attributes['label'] }}
            <span x-show="disabled" class="ml-3 text-grey-400 -mt-0.5"><x-heroicon-s-lock-closed class="inline-block w-3 h-3" /></span>
            <x-loader :action="$model" color="text-blue-700" class="w-2 h-2 ml-2" />
        </label>
    @endif
    @if($attributes->has('desc') || $attributes->has('description'))
        <p class="text-sm text-gray-500">
            {{ $attributes['desc'] ?? $attributes['description'] }}
        </p>
    @endif

    <fieldset class="mt-2">

        @if($attributes->has('label'))
            <legend class="sr-only">Notification method</legend>
        @endif

        <div class="grid grid-cols-1 gap-y-4 md:grid-cols-{{ $cols }} md:gap-x-4">
            
            @foreach ($options as $option)
                   
                <!-- Active: "border-indigo-600 ring-2 ring-indigo-600", Not Active: "border-gray-300" -->
                @php
                    $isActive = $attributes['current'] == $option['value'];
                @endphp
                <label 
                    @class([
                        'relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none',
                        'border-primary ring-2 ring-primary' => $isActive,
                        'border-gray-300' => ! $isActive,
                    ])>
                    <input 
                        id="{{ $option['value'] }}" 
                        name="{{ $option['value'] }}"
                        value="{{ $option['value'] }}"
                        {{ $attributes->wire('model') }}
                        type="radio"
                        class="sr-only">
                    <span class="flex flex-1">
                        <span class="flex flex-col">
                            <span id="project-type-0-label" class="block text-sm font-medium text-gray-900">{{ $option['name'] }}</span>
                            <span id="project-type-0-description-0" class="mt-1 flex items-center text-sm text-gray-500">{{ $option['description'] }}</span>
                        </span>
                    </span>
                    <svg 
                        @class([
                            'h-5 w-5 text-primary',
                            'invisible' => ! $isActive,
                        ])
                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </label>

            @endforeach

        </div>

        </fieldset>

        @error($model)
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror

</div>
  

