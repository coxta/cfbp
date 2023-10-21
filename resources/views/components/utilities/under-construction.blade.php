<div {{ $attributes->merge(['class' => 'flex flex-col w-full items-center space-y-3']) }} >
    <img src="{{ secure_asset('img/under-construction.svg') }}" class="h-{{ $size }}"/>
    <p class="text-xs text-slate-500 uppercase font-semibold tracking-wide">Under Construction</p>
</div>