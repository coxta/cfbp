<span>
    @auth()
        @if ($following)
            <x-button wire:click="toggle" spinner="toggle" label="Unfollow" secondary outline />
        @else
            <x-button wire:click="toggle" spinner="toggle" label="Follow" icon="plus" primary />
        @endif
    @else
        <x-button wire:click="auth" label="Follow" icon="plus" primary />
    @endauth
</span>
