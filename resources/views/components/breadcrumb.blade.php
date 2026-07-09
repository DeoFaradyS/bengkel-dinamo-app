{{-- resources/views/components/breadcrumb.blade.php --}}
@props(['links' => []])

<nav aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        @foreach($links as $label => $url)
        @if(!$loop->last)
        <li class="inline-flex items-center">
            @if($loop->first)
            <a href="{{ $url }}" class="text-sm font-medium text-body hover:text-fg-brand">{{ $label }}</a>
            @else
            <div class="flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                <a href="{{ $url }}" class="text-sm font-medium text-body hover:text-fg-brand">{{ $label }}</a>
            </div>
            @endif
        </li>
        @else
        <li aria-current="page">
            <div class="flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                <span class="text-sm font-medium text-body-subtle">{{ $label }}</span>
            </div>
        </li>
        @endif
        @endforeach
    </ol>
</nav>