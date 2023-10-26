@php
    $model = $attributes->wire('model')->value();
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

    <fieldset class="mt-4">

        @if($attributes->has('label'))
            <legend class="sr-only">Notification method</legend>
        @endif

        <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
            
            @foreach ($options as $option)
                
                <div class="flex flex-row items-center space-x-3">
                    
                    <div class="flex">
                        <input 
                            id="{{ $option['value'] }}" 
                            name="{{ $option['value'] }}"
                            value="{{ $option['value'] }}"
                            {{ $attributes->wire('model') }}
                            type="radio"
                            x-bind:disabled="disabled"
                            :class="{ 'bg-transparent pointer-events-none' : disabled }"
                            class="h-4 w-4 border-muted text-primary focus:ring-primary">
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="{{ $option['value'] }}" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ $option['name'] }}
                        </label>
                        @if(isset($option['description']))
                            <p id="{{ $option['value'] }}-description" class="text-muted text-xs">
                                {{ $option['description'] }}
                            </p>
                        @endif
                    </div>

                </div>

            @endforeach

        </div>

        </fieldset>

        @error($model)
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror

</div>
  

