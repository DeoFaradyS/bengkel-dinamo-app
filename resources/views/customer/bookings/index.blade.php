<x-layouts.dashboard>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-heading">My Bookings</h1>
        <x-button href="{{ route('customer.bookings.create') }}">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            New Booking
        </x-button>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-16">No.</x-table.cell>
                <x-table.cell head>Vehicle</x-table.cell>
                <x-table.cell head>Services</x-table.cell>
                <x-table.cell head>Scheduled At</x-table.cell>
                <x-table.cell head>Status</x-table.cell>
                <x-table.cell head><span class="sr-only">Actions</span></x-table.cell>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse($bookings as $booking)
                <tr>
                    <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }} -
                        {{ $booking->vehicle->license_plate }}</x-table.cell>
                    <x-table.cell>
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->services as $bookingService)
                                <x-badge variant="gray">{{ $bookingService->service->name }}</x-badge>
                            @endforeach
                        </div>
                    </x-table.cell>
                    <x-table.cell>{{ $booking->scheduled_at->format('d M Y, H:i') }}</x-table.cell>
                    <x-table.cell>
                        @php
                            $variants = [
                                'scheduled' => 'warning',
                                'in_progress' => 'brand',
                                'done' => 'success',
                                'cancelled' => 'danger',
                            ];
                        @endphp
                        <x-badge variant="{{ $variants[$booking->status] ?? 'gray' }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </x-badge>
                    </x-table.cell>
                    <x-table.cell>
                        <button data-dropdown-toggle="dropdown-{{ $booking->id }}"
                            class="p-1 text-body-subtle hover:text-body rounded" type="button">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                        <div id="dropdown-{{ $booking->id }}"
                            class="hidden z-10 w-40 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
                            <ul class="py-1 text-sm">
                                <li>
                                    <a href="{{ route('customer.bookings.show', $booking) }}"
                                        class="flex items-center gap-2 px-4 py-2 text-body hover:bg-neutral-tertiary">
                                        <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Detail
                                    </a>
                                </li>
                                @if($booking->status === 'scheduled')
                                    <li>
                                        <form action="{{ route('customer.bookings.destroy', $booking) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-full text-left flex items-center gap-2 px-4 py-2 text-danger hover:bg-neutral-tertiary">
                                                <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                        d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Cancel
                                            </button>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </x-table.cell>
                </tr>
            @empty
                <x-table.empty message="No bookings found." colspan="6" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>