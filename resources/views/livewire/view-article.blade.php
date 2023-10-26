<div>

    @slot('title')
        {{ $headline ?? 'Article' }}
    @endslot

    <div class="flex flex-col items-center">
        <div class="bg-white rounded-lg shadow p-8 max-w-4xl">
            <article class="prose max-w-none">
                <h2>{{ $headline }}</h2>
                {!! $story !!}
            </article>
        </div>
    </div>

</div>