<div>
    @switch($network)
        @case('ESPN')
            <img src="https://a.espncdn.com/redesign/assets/img/logos/networks/espn-red@2x.png" class="h-{{ $size }}"/>
            @break
        @case('ESPN2')
            <img src="https://a.espncdn.com/redesign/assets/img/logos/networks/espn-2@2x.png" class="h-{{ $size }}"/>
            @break
        @case('ABC')
            <img src="https://a.espncdn.com/redesign/assets/img/logos/networks/espn-abc@2x.png" class="h-{{ $size + 2 }}"/>
            @break
        @default
            <span class="font-bold text-gray-700 text-sm">{{ $network }}</span>
    @endswitch
</div>