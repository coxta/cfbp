@if($link && !empty($link))
    <a
        href="{!! $link !!}"
        @if($disabled)
        disabled
        @endif
        {{ $attributes->merge(['class' => $class]) }}
        {{ $attributes }}
        >
        @if($icon || $action)
            <x-loader :action="$action" icon="{{ $icon }}" color="{{ $iconColor }}" size="{{ $iconSize }}" />
        @endif
        {{  $slot  }}
    </a>
@else
    @if($confirm)
    <div x-data="{ confirmed: false }" @click.away="confirmed = false">
    @endif
    <button
        @if($confirm) x-cloak x-show="confirmed" @endif
        type="{{ $type }}"
        @if($action)
        wire:click="{{ $action }}"
        @endif
        @if($disabled)
        disabled
        @endif
        {{ $attributes->merge(['class' => $class]) }}
        {{ $attributes }}
        >
        @if($icon || $action)
            <x-loader :action="$action" icon="{{ $icon }}" color="{{ $iconColor }}" size="{{ $iconSize }}" />
        @endif
        @if($confirm) Confirm @endif
        {{  $slot  }}
    </button>
    @if($confirm)
        <button
            x-show="!confirmed"
            @click="confirmed = true"
            type="button"
            @if($disabled)
            disabled
            @endif
            {{ $attributes->merge(['class' => $class]) }}
            {{ $attributes }}
            >
            @if($icon || $action)
                <x-loader :action="$action" icon="{{ $icon }}" color="{{ $iconColor }}" size="{{ $iconSize }}" />
            @endif
            {{  $slot  }}
        </button>
    </div>
    @endif
@endif