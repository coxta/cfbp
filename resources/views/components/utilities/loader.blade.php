<div class="{{ $attributes['class'] ?? '' }} text-{{ $color }} flex items-center">

    @if ($action)
        <svg wire:loading wire:target="{{ $action }}"
            class="inline-block animate-spin w-{{ (int) $size - 1 }} h-{{ (int) $size - 1 }} md:w-{{ $size }} md:h-{{ $size }} mr-{{ $size / 2 }}"
            viewBox="0 0 24 24">
            <circle class="opacity-0" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    @elseif(!$action && !$icon)
        <svg class="inline-block animate-spin w-{{ (int) $size - 1 }} h-{{ (int) $size - 1 }} md:w-{{ $size }} md:h-{{ $size }} mr-{{ $size / 2 }}"
            viewBox="0 0 24 24">
            <circle class="opacity-0" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
    @endif

    @if ($icon && $action)
        <x-dynamic-component wire:loading.remove wire:target="{{ $action }}" :component="$icon"
            class="inline-block w-{{ (int) $size - 1 }} h-{{ (int) $size - 1 }} md:w-{{ $size }} md:h-{{ $size }} mr-{{ $size / 2 }}" />
    @elseif($icon)
        <x-dynamic-component :component="$icon"
            class="inline-block w-{{ (int) $size - 1 }} h-{{ (int) $size - 1 }} md:w-{{ $size }} md:h-{{ $size }} mr-{{ $size / 2 }}" />
    @endif

</div>