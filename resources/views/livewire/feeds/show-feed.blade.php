@php
use Carbon\Carbon;
@endphp

<div x-data="{ editing: @entangle('editing').live }" x-cloak>

    @slot('title')
        Feeds | {{ $feed->name }}
    @endslot

    <!-- Header -->
    <div class="flex items-center justify-between space-x-5">
        <div class="flex items-center space-x-5">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $feed->name }}</h1>
                <p class="text-sm font-medium text-gray-500">{{ $feed->description }}</p>
            </div>
        </div>
        <div
            class="mt-6 flex flex-col-reverse justify-stretch space-y-4 space-y-reverse sm:flex-row-reverse sm:justify-end sm:space-x-reverse sm:space-y-0 sm:space-x-3 md:mt-0 md:flex-row md:space-x-3">
            <x-button primary outline wire:click="$toggle('editing')" label="{{ $editing ? 'Cancel' : 'Edit' }}" />
            @unless($editing)
                <x-button primary wire:click="run" label="Run" />
            @endunless
        </div>
    </div>

    <!-- Edit -->
    <div x-show="editing" class="mt-8">
        <div class="text-xl font-semibold tracking-wide">Edit Feed</div>
        <div class="mt-4">

            <x-input wire:model.blur="feed.name" label="Name" placeholder="Scoreboard" />
            <x-input wire:model.blur="feed.description" label="Description" placeholder="Polls the ESPN Scoreboard API for updates" />
            <x-input wire:model.blur="feed.job" label="Job" placeholder="App\Jobs\Feeds\Scoreboard" />
            <x-input wire:model.blur="feed.frequency" label="Frequency" placeholder="Every 5 Minutes" />

            <div class="flex justify-center space-x-4 my-4">
                <x-button negative outline wire:click="$toggle('editing')" label="Cancel" />
                <x-button primary wire:click="save" icon="circle-stack" label="Save" />
            </div>

        </div>
    </div>

    <div class="flex flex-col mt-6 mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Job Id
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Queued
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Started
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Info
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($logs as $log)



                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                       {{ $log->job_id ?? $log->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Carbon::parse($log->created_at)->setTimezone('America/New_York')->format('M jS, g:i:s a') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ Carbon::parse($log->started_at)->setTimezone('America/New_York')->format('M jS, g:i:s a') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->disposition }}<span class="text-xs text-gray-500 font-semibold ml-2">{{ $log->duration }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $log->exception ?? ($log->disposition == 'Complete' ? 'Success' : '-') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $logs->links() }}

</div>