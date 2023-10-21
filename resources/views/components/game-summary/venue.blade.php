{{-- <div class="flex flex-col rounded-lg bg-white shadow"> --}}
<div class="flex flex-col rounded-lg shadow overflow-hidden">

    <div class="flex-shrink-0">
        <img class="w-full object-cover object-top h-40" src="{{ isset($venue['images'][1]) ? $venue['images'][1]['href'] : $venue['images'][0]['href'] }}" alt="">
    </div>
    <div class="flex flex-col flex-1 bg-white px-4 py-2">
        <h2 class="text-base font-bold">
            {{ $venue['fullName'] }}
        </h2>
        <div class="flex flex-row items-center space-x-2 my-1">
            <img src="{{ secure_asset('img/location.svg') }}" class="h-4"/>
            <div class="text-sm font-normal text-gray-900">
                {{ $venue['address']['city'] . ', ' . $venue['address']['state'] }}
            </div>
        </div>
        <div class="flex flex-row items-center my-1">
            <div class="flex flex-row items-center space-x-2 w-1/2">
                <img src="{{ secure_asset('img/fans.svg') }}" class="h-4"/>
                <div class="text-sm font-normal text-gray-900">
                    {{ number_format($venue['capacity']) }}
                </div>
            </div>
            <div class="flex flex-row items-center space-x-1 w-1/2">
                <img src="{{ secure_asset('img/grass.svg') }}" class="h-4"/>
                <div class="text-sm font-normal text-gray-900">
                    {{ $venue['grass'] ? 'Grass' : 'Artificial' }}
                </div>
            </div>
        </div>
    </div>
</div>