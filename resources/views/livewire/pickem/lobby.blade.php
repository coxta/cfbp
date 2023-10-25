<div x-data="{creating: 'none'}">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between w-full mb-4">

        <div 
            x-text="creating == 'group' ? 'Create a Group' : (creating == 'contest' ? 'Create a Contest' : 'Lobby')"
            class="text-dark">
        </div>

        <div 
            x-show="creating == 'none'"
            class="flex flex-row items-end space-x-4">
            <x-button @click="creating = 'group'" color="blue">Create a Group</x-button>
            <x-button @click="creating = 'contest'" color="blue">Create a Contest</x-button>
        </div>

    </div>

    <!-- Wrapping Grid -->
    <div 
        x-show="creating == 'group'"
        class="">
        <x-button @click="creating = 'none'" color="red" outline>Cancel</x-button>
    </div>
    <div 
        x-show="creating == 'contest'"
        class="">
        <x-button @click="creating = 'none'" color="red" outline>Cancel</x-button>
    </div>

    <!-- Wrapping Grid -->
    <div 
        x-show="creating == 'none'"
        class="mx-auto grid grid-cols-1 lg:grid-cols-12 gap-2 lg:gap-4 items-start">

        <div class="flex flex-col rounded-lg bg-white shadow px-4 py-3 lg:col-span-4">

            <div class="flex flex-row items-end justify-between">
                <h2 class="text-slate-700 font-semibold text-sm">My Groups</h2>
                <div class="text-xs text-muted">Members</div>
            </div>
        
            @if(count($myGroups) > 0)
                <div class="flex flex-col space-y-1 mt-2">
                    @foreach($myGroups as $myGroup)
                        <a href="{{ route('group', ['group' => $myGroup->id]) }}" class="flex flex-row items-center px-2 py-1 hover:bg-gray-100 hover:font-semibold justify-between text-sm">
                            <div class="text-primary">{{ $myGroup->name }}</div>
                            <div>0</div>
                        </a>
                    @endforeach
                </div>
            @else
                <div>No groups...</div>
            @endif
        
        </div>

        <div class="flex flex-col rounded-lg bg-white shadow px-4 py-3 lg:col-span-4">

            <h2 class="text-slate-700 font-semibold text-sm pb-2">Contests</h2>
        
            <x-under-construction size="16" class="py-12" />
        
        </div>

        <div class="flex flex-col rounded-lg bg-white shadow px-4 py-3 lg:col-span-4">

            <div class="flex flex-row items-end justify-between">
                <h2 class="text-slate-700 font-semibold text-sm">Public Groups</h2>
                <div class="text-xs text-muted">Members</div>
            </div>
        
            @if(count($publicGroups) > 0)
                <div class="flex flex-col space-y-1 mt-2">
                    @foreach($publicGroups as $publicGroup)
                        <a href="{{ route('group', ['group' => $publicGroup->id]) }}" class="flex flex-row items-center px-2 py-1 hover:bg-gray-100 hover:font-semibold justify-between text-sm">
                            <div class="text-primary">{{ $publicGroup->name }}</div>
                            <div>0</div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="m-4 text-sm text-muted">
                    No public groups...
                </div>
            @endif
        
        </div>

    </div>
</div>
