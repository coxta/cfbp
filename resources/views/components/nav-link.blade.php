@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex flex-row items-center text-primary bg-light group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold'
            : 'flex flex-row items-center text-dark hover:text-primary hover:bg-light group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>