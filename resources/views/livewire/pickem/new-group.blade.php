<div x-data class="flex flex-col items-center">

    <div class="flex flex-col space-y-4 bg-white rounded-lg shadow p-8 w-full max-w-xl">

        <div class="flex flex-row items-center justify-between">
            <h3 class="text-lg font-semibold">Create a group</h3>
            <x-heroicon-o-x-circle @click="$dispatch('create-group-cancel')" class="w-6 h-6 cursor-pointer text-danger"/>
        </div>

        <x-button color="blue">Create Group</x-button>

    </div>

</div>