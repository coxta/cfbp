<div>
    @switch($network)
        @case('SECN')
            <img src="{{ secure_asset('img/secn.svg') }}" class="h-{{ $size + 2 }}"/>
            @break
        @case('ESPN')
            <img src="https://a.espncdn.com/redesign/assets/img/logos/networks/espn-red@2x.png" class="h-{{ $size }}"/>
            @break
        @case('ESPN2')
            <img src="https://a.espncdn.com/redesign/assets/img/logos/networks/espn-2@2x.png" class="h-{{ $size }}"/>
            @break
        @case('ABC')
            <img src="https://a.espncdn.com/redesign/assets/img/logos/networks/espn-abc@2x.png" class="h-{{ $size + 2 }}"/>
            @break
        @case('ESPN+')
            <img src="{{ secure_asset('img/espnp.svg') }}" class="h-{{ $size }}"/>
            @break
        @case('ESPNU')
            <img src="{{ secure_asset('img/espnu.svg') }}" class="h-{{ $size + 2 }}"/>
            @break
        @case('PAC12')
            <img src="{{ secure_asset('img/pac.svg') }}" class="h-{{ $size + 2 }}"/>
            @break
        @case('NBC')
            <img src="{{ secure_asset('img/nbc.svg') }}" class="h-{{ $size + 3 }}"/>
            @break
        @case('ACCN')
            <img src="{{ secure_asset('img/accn.svg') }}" class="h-{{ $size + 1 }}"/>
            @break
        @case('CBS')
            <img src="{{ secure_asset('img/cbs.svg') }}" class="h-{{ $size + 1 }}"/>
            @break
        @case('CBSS')
            <img src="{{ secure_asset('img/cbss.svg') }}" class="h-{{ $size + 1 }}"/>
            @break
        @case('CBSSN')
            <img src="{{ secure_asset('img/cbss.svg') }}" class="h-{{ $size + 1 }}"/>
            @break
        @case('BTN')
            <img src="{{ secure_asset('img/btn.svg') }}" class="h-{{ $size + 1 }}"/>
            @break
        @case('CW')
            <img src="{{ secure_asset('img/cw.svg') }}" class="h-{{ $size + 1 }}"/>
            @break    
        @case('FOX')
            <img src="{{ secure_asset('img/fox.svg') }}" class="h-{{ $size + 1 }}"/>
            @break     
        @case('FS1')
            <img src="{{ secure_asset('img/fs1.svg') }}" class="h-{{ $size + 1 }}"/>
            @break  
        @case('FS2')
            <img src="{{ secure_asset('img/fs2.svg') }}" class="h-{{ $size + 1 }}"/>
            @break              
        @default
            <span class="font-bold text-gray-700 text-sm">{{ $network }}</span>
    @endswitch
</div>