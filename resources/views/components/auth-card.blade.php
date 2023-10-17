<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    @if ($logo ?? null)
        <div>
            {{ $logo ?? null }}
        </div>
    @endif

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>

    @if ($under ?? null)
        <div class="mt-4">
            {{ $under ?? null }}
        </div>
    @endif

</div>
