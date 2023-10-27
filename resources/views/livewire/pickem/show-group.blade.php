<div x-data>

    <livewire:pickem.new-group />

    {{-- <livewire:pickem.new-contest /> --}}

    <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row md:items-center md:justify-between w-full mb-4">

        <h2 class="text-dark">{{ $group->name }}</h2>
        
        <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row md:space-x-4">
            @if($group->type->name == 'Public' && auth()->id() == $group->user_id)
                <x-button action="delete" wire:confirm.prompt="Are you sure you want to delete this group?\n\nType DELETE to confirm|DELETE" color="red" icon="trash" block class="w-full md:w-auto">
                    Delete
                </x-button>
            @endif
        </div>

    </div>

    @if($new)
        <p>Oh cool, a new group</p>
    @endif
    
</div>
