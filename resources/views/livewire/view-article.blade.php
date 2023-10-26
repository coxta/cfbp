<div>

    @slot('title')
        {{ $headline ?? 'Article' }}
    @endslot

    <div class="flex bg-white rounded-lg shadow p-8">
        <article class="prose max-w-none">
            <h2>{{ $headline }}</h2>
            {!! $story !!}
        </article>
    </div>

</div>