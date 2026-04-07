@props(['status'])

@php
    $classes = match ($status) {
        'published' => 'bg-success',
        'draft' => 'bg-secondary',
        default => 'bg-dark',
    };

    $label = match ($status) {
        'published' => 'Đã xuất bản',
        'draft' => 'Bản nháp',
        default => ucfirst($status),
    };
@endphp

<span class="badge {{ $classes }}">{{ $label }}</span>
