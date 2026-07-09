@props([
    'label' => '',
    'name' => '',
    'error' => null,
    'value' => null,
    'required' => false,
])

<div>
    <label for="{{ $name }}" class="block mb-2.5 text-sm font-semibold {{ $error ? 'text-fg-danger-strong' : 'text-heading' }}">
        {{ $label }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => $error
            ? 'bg-danger-soft border border-danger-subtle text-fg-danger-strong text-sm rounded-base focus:ring-danger focus:border-danger block w-full px-3 py-2.5 shadow-xs placeholder:text-fg-danger-strong'
            : 'bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body'
        ]) }}
    />

    @error($name)
        <p class="mt-2.5 text-sm text-fg-danger-strong">{{ $message }}</p>
    @enderror
</div>