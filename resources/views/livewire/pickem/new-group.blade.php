
<div x-data="{creating: false}" @create-group.window="creating = true" x-show="creating" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
    Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed z-50 inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-50 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all my-8 w-full max-w-xl p-6">
            <div class="flex flex-row items-center justify-between">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create a Group</h3>
                <button @click="creating = false" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div class="flex flex-col space-y-6 mt-2 w-full text-left">
                <x-input.text wire:model.blur="group.name" label="Group Name" placeholder="Enter group name"/>                
                <x-input.choice 
                    wire:model.live="group.type_id"
                    :current="$group->type_id"
                    columns="2"
                    label="Group Type"
                    :options="$typeOptions" />
            </div>
        <div class="mt-8 flex flex-row items-center justify-around">
            <x-button action="create" color="blue">
                Create {{ $group->type->name }} Group
            </x-button>
        </div>
        </div>
    </div>
    </div>
</div>