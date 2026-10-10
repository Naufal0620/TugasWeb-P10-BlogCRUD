@props(['title' => null])

<div {{ $attributes->merge(['class' => 'card border-0 shadow-sm rounded-3']) }}>
    @if($title || isset($header))
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            @if($title)
                <h5 class="card-title fw-bold mb-0">{{ $title }}</h5>
            @else
                {{ $header }}
            @endif
        </div>
    @endif
    <div class="card-body p-4">
        {{ $slot }}
    </div>
</div>
