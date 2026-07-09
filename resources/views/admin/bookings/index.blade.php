<x-layouts.dashboard>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-heading">Bookings</h1>
    </div>

    <div class="grid grid-cols-4 gap-6">
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Total</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $total }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Scheduled</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $scheduled }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">In Progress</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $in_progress }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Done</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $done }}</p>
        </x-card>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-16">No.</x-table.cell>
                <x-table.cell head>Customer</x-table.cell>
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
                    <x-table.cell>{{ $booking->user->name }}</x-table.cell>
                    <x-table.cell>{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }} - {{ $booking->vehicle->license_plate }}</x-table.cell>
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
                                'scheduled'   => 'warning',
                                'in_progress' => 'brand',
                                'done'        => 'success',
                                'cancelled'   => 'danger',
                            ];
                        @endphp
                        <x-badge variant="{{ $variants[$booking->status] ?? 'gray' }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </x-badge>
                    </x-table.cell>
                    <x-table.cell>
                        <a href="{{ route('admin.bookings.show', $booking) }}"
                            class="flex items-center gap-2 px-3 py-1.5 text-sm text-body hover:bg-neutral-tertiary rounded-base">
                            <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            Detail
                        </a>
                    </x-table.cell>
                </tr>
                @empty
                    <x-table.empty message="No bookings found." colspan="7" />
                @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>