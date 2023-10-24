@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex flex-row items-center font-semibold text-dark bg-light group flex gap-x-3 rounded-md p-1.5 text-sm leading-6'
            : 'flex flex-row items-center text-dark hover:font-semibold hover:bg-light group flex gap-x-3 rounded-md p-1.5 text-sm leading-6';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>