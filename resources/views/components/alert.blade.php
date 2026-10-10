@props(['type' => 'info'])

@php
$classes = [
    'info' => 'alert-info text-dark',
    'success' => 'alert-success text-dark',
    'warning' => 'alert-warning text-dark',
    'danger' => 'alert-danger text-dark',
][$type] ?? 'alert-info';
@endphp

<div {{ $attributes->merge(['class' => 'alert ' . $classes . ' alert-dismissible fade show shadow-sm rounded-3']) }} role="alert">
    {{ $slot }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
