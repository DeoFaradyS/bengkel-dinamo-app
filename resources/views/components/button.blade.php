@props([
    'variant' => 'primary',
    'href' => null,
    'icon' => false,
])

@php
    $variants = [
        'primary' => 'text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium',
        'secondary' => 'text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary',
        'tertiary' => 'text-body bg-neutral-primary-soft border border-default hover:bg-neutral-secondary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary-soft',
        'success' => 'text-white bg-success box-border border border-transparent hover:bg-success-strong focus:ring-4 focus:ring-success-medium',
        'danger' => 'text-white bg-danger box-border border border-transparent hover:bg-danger-strong focus:ring-4 focus:ring-danger-medium',
        'warning' => 'text-white bg-warning box-border border border-transparent hover:bg-warning-strong focus:ring-4 focus:ring-warning-medium',
        'dark' => 'text-white bg-dark box-border border border-transparent hover:bg-dark-strong focus:ring-4 focus:ring-neutral-tertiary',
        'ghost' => 'text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary',
    ];

    $baseClasses = $icon
        ? 'inline-flex items-center justify-center shadow-xs rounded-base w-9 h-9 focus:outline-none'
        : 'inline-flex items-center justify-center gap-2 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none';

    $classes = ($variants[$variant] ?? $variants['primary']) . ' ' . $baseClasses;
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif