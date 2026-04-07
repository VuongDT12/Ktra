@props(['title' => null, 'subtitle' => null])

<div class="card h-100 shadow-sm border-0">
    <div class="card-body">
        @if($title)
            <h5 class="card-title">{{ $title }}</h5>
        @endif
        @if($subtitle)
            <p class="card-text text-muted">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
    </div>
</div>
