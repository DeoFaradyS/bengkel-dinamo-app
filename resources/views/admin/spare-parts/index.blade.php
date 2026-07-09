<x-layouts.dashboard>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-heading">Spare Parts</h1>
        <x-button href="{{ route('admin.spare-parts.create') }}">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
            </svg>
            Add Spare Part
        </x-button>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Total Spare Parts</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $total }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Active Spare Parts</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $active }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Inactive Spare Parts</p>
            <p class="text-3xl font-semibold text-danger">{{ $inactive }}</p>
        </x-card>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-20 text-center">No</x-table.cell>
                <x-table.cell head>Name</x-table.cell>
                <x-table.cell head>Category</x-table.cell>
                <x-table.cell head>Brand</x-table.cell>
                <x-table.cell head>Part Number</x-table.cell>
                <x-table.cell head>Stock (New/Used)</x-table.cell>
                <x-table.cell head>Status</x-table.cell>
                <x-table.cell head class="w-20"><span class="sr-only">Actions</span></x-table.cell>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse($spareParts as $sparePart)
                @php
                    $stockNew  = $sparePart->stocks->firstWhere('condition', 'new');
                    $stockUsed = $sparePart->stocks->firstWhere('condition', 'used');
                @endphp
                <tr>
                    <x-table.cell class="text-center">{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $sparePart->name }}</x-table.cell>
                    <x-table.cell>{{ $sparePart->category->name }}</x-table.cell>
                    <x-table.cell>{{ $sparePart->brand }}</x-table.cell>
                    <x-table.cell>{{ $sparePart->part_number }}</x-table.cell>
                    <x-table.cell>{{ $stockNew?->stock ?? 0 }} / {{ $stockUsed?->stock ?? 0 }}</x-table.cell>
                    <x-table.cell >
                        <x-badge variant="{{ $sparePart->is_active ? 'success' : 'danger' }}">
                            {{ $sparePart->is_active ? 'Active' : 'Inactive' }}
                        </x-badge>
                    </x-table.cell>
                    <x-table.cell>
                        <button data-dropdown-toggle="dropdown-{{ $sparePart->id }}"
                            class="p-1 text-body-subtle hover:text-body rounded" type="button">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </button>
                        <div id="dropdown-{{ $sparePart->id }}"
                            class="hidden z-10 w-40 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
                            <ul class="py-1 text-sm">
                                <li>
                                    <a href="{{ route('admin.spare-parts.edit', $sparePart) }}"
                                        class="flex items-center gap-2 px-4 py-2 text-body hover:bg-neutral-tertiary">
                                        <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('admin.spare-parts.update', $sparePart) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="{{ $sparePart->is_active ? 0 : 1 }}">
                                        <button type="submit"
                                            class="w-full text-left flex items-center gap-2 px-4 py-2 hover:bg-neutral-tertiary {{ $sparePart->is_active ? 'text-danger' : 'text-body' }}">
                                            @if($sparePart->is_active)
                                                <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                Deactivate
                                            @else
                                                <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                                Activate
                                            @endif
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </x-table.cell>
                </tr>
            @empty
                <x-table.empty message="No spare parts found." colspan="8" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>