<div class="rounded-lg bg-white shadow px-4 py-3 divide-y">
    
    <h2 class="text-slate-700 font-semibold text-sm pb-2">Playmakers</h2>

    <div class="flex flex-col items-center justify-around divide-y">
        @foreach ($stats as $stat)

        <div class="py-2 w-full">
            
            <div class="flex flex-row justify-around text-slate-700 font-semibold text-xs py-2">
                <h2>{{ $stat['stat'] }}</h2>
            </div>

            <div class="w-full flex flex-row items-center divide-x text-xs w-full">

                <!-- Athlete 1 -->
                <div class="flex flex-col items-end w-1/2 pr-2">

                    <div class="text-slate-800 text-xs font-semibold">{{ $stat['leaders'][0]['name'] }}</div>

                    <div class="w-full flex flex-row items-start justify-between">
                        
                        <div class="flex flex-col items-center space-x-0.5 shrink-0">
                            <img src="{{ $stat['leaders'][0]['headshot'] }}" class="h-10 w-10 shrink-0 rounded-full border"/>
                            <div class="text-slate-500 text-[9px]">{{ $stat['leaders'][0]['team'] }}</div>
                        </div>

                        <div class="flex flex-col items-end py-1 pl-1">
                            <div class="text-slate-500 text-[10px] text-right tracking-tight">{{ $stat['leaders'][0]['value'] }}</div>
                        </div>

                    </div>

                </div>

                <!-- Athlete 2 -->
                <div class="flex flex-col items-start w-1/2 pl-2">

                    <div class="text-slate-800 text-xs font-semibold">{{ $stat['leaders'][1]['name'] }}</div>

                    <div class="w-full flex flex-row items-start justify-between">

                        <div class="flex flex-col items-start py-1 pr-1">
                            <div class="text-slate-500 text-[10px] tracking-tight">{{ $stat['leaders'][1]['value'] }}</div>
                        </div>

                        <div class="flex flex-col items-center space-x-0.5 shrink-0">
                            <img src="{{ $stat['leaders'][1]['headshot'] }}" class="h-10 w-10 shrink-0 rounded-full border"/>
                            <div class="text-slate-500 text-[9px]">{{ $stat['leaders'][1]['team'] }}</div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        @endforeach
    </div>

</div>