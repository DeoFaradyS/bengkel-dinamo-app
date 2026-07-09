@props([
    'variant' => 'success',
    'message' => '',
])

@php
    $icons = [
        'success' => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>',
        'danger'  => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>',
        'warning' => '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>',
    ];

    $colors = [
        'success' => 'text-fg-success bg-success-soft',
        'danger'  => 'text-fg-danger bg-danger-soft',
        'warning' => 'text-fg-warning bg-warning-soft',
    ];

    $id = 'toast-' . $variant;
@endphp

<div id="{{ $id }}" class="flex items-center w-full max-w-sm p-4 text-body bg-neutral-primary-soft rounded-base shadow-xs border border-default" role="alert">
    <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 {{ $colors[$variant] }} rounded">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            {!! $icons[$variant] !!}
        </svg>
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
    <button type="button" data-dismiss-target="#{{ $id }}" aria-label="Close"
        class="ms-auto flex items-center justify-center text-body hover:text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary rounded text-sm h-8 w-8 focus:outline-none">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
        </svg>
    </button>
</div>

@props([
    'variant' => 'success',
    'message' => '',
])

@php
    $variants = [
        'success' => ['text-fg-success bg-success-soft', '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/>'],
        'danger'  => ['text-fg-danger bg-danger-soft', '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>'],
        'warning' => ['text-fg-warning bg-warning-soft', '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'],
    ];
    [$color, $icon] = $variants[$variant];
    $closeIcon = $variants['danger'][1]; // ponytail: same X path reused for close button
    $id = 'toast-' . Str::random(8); // fix: was 'toast-'.$variant, collided across multiple toasts of same variant
@endphp

<div id="{{ $id }}" class="flex items-center w-full max-w-sm p-4 text-body bg-neutral-primary-soft rounded-base shadow-xs border border-default" role="alert">
    <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 {{ $color }} rounded">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            {!! $icon !!}
        </svg>
    </div>
    <div class="ms-3 text-sm font-normal">{{ $message }}</div>
    <button type="button" data-dismiss-target="#{{ $id }}" aria-label="Close"
        class="ms-auto flex items-center justify-center text-body hover:text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary rounded text-sm h-8 w-8 focus:outline-none">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            {!! $closeIcon !!}
        </svg>
    </button>
</div>