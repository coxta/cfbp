@php
$model = $attributes->wire('model')->value();
@endphp
<div @if ($attributes->has('disabled')) x-data="{ disabled: @entangle($attributes['disabled']).live}"
 @else
     x-data="{ disabled: false }" @endif class="w-full lg:mt-3 {{ $attributes['class'] }} ">
    @if ($attributes->has('label'))
        <label for="{{ $model }}" class="flex items-center mb-1 text-xs font-medium text-gray-500">
            {{ $attributes['label'] }}
            <span x-show="disabled" class="ml-3 text-grey-400 -mt-0.5">
                <x-heroicon-s-lock-closed class="inline-block w-3 h-3" />
            </span>
            <x-elements.loading.spinner wire:target="{{ $model }}" color="text-blue-700" class="w-2 h-2 ml-1" />
        </label>
    @endif
    <div x-data="Components.inputSelect({ element: '{{ $model }}', open: false, value: 1, selected: 1 })"
        x-init="init()">
        <div class="relative block lg:hidden">
            <select id="{{ $model }}-select" wire:model.live="{{ $model }}"
                {{ $attributes->has('disabled') ? 'disabled' : '' }}
                x-on:change="setOption($event.target.options[$event.target.selectedIndex].getAttribute('key'), $event.target.value)"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-700 focus:border-blue-700 text-sm {{ $attributes['disabled'] ? 'bg-transparent' : '' }} @error($model){{ 'text-red-700 placeholder-red-300 border-red-300 focus:ring-red-500 focus:border-red-700' }}@enderror">
                    @foreach ($options as $key => $option)
                        <option key="{{ $key + 1 }}" value="{{ $option['value'] }}">{{ $option['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="relative hidden lg:block sm:hidden">
                <span class="inline-block w-full rounded-md shadow-sm">
                    <button x-ref="button" x-on:click="onButtonClick()" type="button" aria-haspopup="listbox"
                        :aria-expanded="open"
                        class="relative w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none sm:text-sm sm:leading-5 @error($model){{ 'text-red-700 placeholder-red-300 border-red-300 focus:ring-red-500 focus:border-red-700' }}@enderror">
                            <div class="flex items-center space-x-3">
                                <span x-text="[ @if ($options)
                                    @foreach ($options as $option) '{{ $option['name'] }}', @endforeach @endif ][value - 1]"
                                    class="block truncate"></span>
                            </div>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                @error($model)
                                    <x-heroicon-s-selector
                                        class="flex-shrink-0 w-5 h-5 text-red-700 placeholder-red-300 border-red-300 group-hover:text-gray-400 focus:ring-red-500 focus:border-red-700" />
                                @else
                                    <x-heroicon-s-selector class="flex-shrink-0 w-5 h-5 text-gray-300 group-hover:text-gray-400" />
                                @enderror
                            </span>
                        </button>
                    </span>
                    <div x-show="open" x-on:click.away="open = false" x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg"
                        style="display: none;">

                        @if ($searchable)
                            <input x-on:keyUp="search($event.target.value)" type="text"
                                class="block w-full pr-10 border border-gray-300 focus:ring-0 focus:outline-none sm:text-sm"
                                placeholder="Search...">
                        @endif

                        <ul @keydown.enter.stop.prevent="onOptionSelect()" @keydown.space.stop.prevent="onOptionSelect()"
                            @keydown.escape="onEscape()" @keydown.arrow-up.prevent="onArrowUp()"
                            @keydown.arrow-down.prevent="onArrowDown()" x-ref="listbox" tabindex="-1" role="listbox"
                            :aria-activedescendant="activeDescendant"
                            class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-56 focus:outline-none sm:text-sm sm:leading-5">

                            @if ($options)
                                @foreach ($options as $key => $value)
                                    <li role="option" data-name="{{ $value['name'] }}"
                                        x-on:click="updateOption({{ $key + 1 }}, '{{ $value['value'] }}')"
                                        @mouseenter="selected = {{ $key + 1 }}" @mouseleave="selected = null"
                                        :class="{ 'text-white bg-blue-800': selected === {{ $key + 1 }}, 'text-gray-700': !(selected === {{ $key + 1 }}) }"
                                        class="relative py-2 pl-4 text-gray-700 cursor-default select-none pr-9 {{ $model }}-option">
                                        <div class="flex items-center space-x-3">
                                            <span
                                                :class="{ 'font-semibold': value === {{ $key + 1 }}, 'font-normal': !(value === {{ $key + 1 }}) }"
                                                class="block font-normal truncate">
                                                {{ $value['name'] }}
                                            </span>
                                        </div>
                                        <span x-show="value === {{ $key + 1 }}"
                                            :class="{ 'text-white': selected === {{ $key + 1 }}, 'text-blue-800': !(selected === {{ $key + 1 }}) }"
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-800"
                                            style="display: none;">
                                            <x-heroicon-s-check class="w-5 h-5" />
                                        </span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @error($model)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>