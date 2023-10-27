<x-app-layout>

    @slot('title')
        Server Error
    @endslot

    <div class="grid min-h-full place-items-center px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-primary">500</p>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Whoops...</h1>
            <p class="mt-6 text-base leading-7 text-gray-600">Something bad happened.  Sorry about that, we'll start working on a bugfix.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{ route('home') }}"
                    class="rounded-md bg-primary px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
                    Go Home
                </a>
            </div>
        </div>
    </div>

</x-app-layout>