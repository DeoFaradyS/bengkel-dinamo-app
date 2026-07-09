@props(['variant' => 'gray'])

@php
$variants = [
    'brand'   => 'bg-brand-softer border border-brand-subtle text-fg-brand-strong',
    'gray'    => 'bg-neutral-secondary-medium border border-default-medium text-heading',
    'danger'  => 'bg-danger-soft border border-danger-subtle text-fg-danger-strong',
    'success' => 'bg-success-soft border border-success-subtle text-fg-success-strong',
    'warning' => 'bg-warning-soft border border-warning-subtle text-fg-warning',
];
@endphp

<span {{ $attributes->merge(['class' => 'text-xs font-medium px-1.5 py-0.5 rounded ' . $variants[$variant]]) }}>
    {{ $slot }}
</span>