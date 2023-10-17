<title>
    @if($title)
    {{ config('app.name', 'CFBP') . ' | ' . $title }}
    @else
    {{ config('app.name', 'CFBP') }}
    @endif
</title>