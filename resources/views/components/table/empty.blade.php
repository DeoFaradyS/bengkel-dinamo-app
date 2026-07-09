
@props([
    'message' => 'No data found.',
    'colspan' => 1,
])

<tr>
    <td colspan="{{ $colspan }}" class="px-4 py-12 text-center">
        <div class="flex flex-col items-center gap-2">
            <svg class="w-10 h-10 text-fg-disabled" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <p class="text-sm text-body-subtle">{{ $message }}</p>
        </div>
    </td>
</tr>