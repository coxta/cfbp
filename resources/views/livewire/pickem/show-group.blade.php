<div x-data wire:init="notifications">

    <livewire:pickem.new-contest :group="$group"/>

    <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row md:items-center md:justify-between w-full mb-4">

        <h2 class="text-dark">{{ $group->name }}</h2>
        
        <div class="flex flex-col space-y-2 md:space-y-0 md:flex-row md:space-x-4">
            @auth
                <x-button positive @click="$dispatch('create-contest')" icon="trophy" label="Create a Contest" class="w-full md:w-auto"/>
            @else
                <x-button positive href="{{ route('login', ['from' => 'lobby']) }}" icon="trophy" label="Create a Contest" class="w-full md:w-auto"/>
            @endif
            @if($group->type->name == 'Public' && auth()->id() == $group->user_id)
                <x-button negative wire:click="delete" wire:confirm.prompt="Are you sure you want to delete this group?\n\nType DELETE to confirm|DELETE" icon="trash" label="Delete" class="w-full md:w-auto"/>
            @endif
        </div>

    </div>
    
</div>
