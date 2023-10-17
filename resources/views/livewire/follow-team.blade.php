<x-button
    action="toggle"
    color="{{ $following ? 'gray' : 'blue' }}"
    icon="{{ $following ? '' : 'plus' }}"
    block
>
    {{ $following ? 'Unfollow' : 'Follow' }}
</x-button>