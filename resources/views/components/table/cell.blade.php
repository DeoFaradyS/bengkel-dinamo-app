@props(['head' => false])

@if($head)
<th {{ $attributes->merge(['class' => 'px-4 py-3']) }}>
    {{ $slot }}
</th>
@else
<td {{ $attributes->merge(['class' => 'px-4 py-3 text-body']) }}>
    {{ $slot }}
</td>
@endif