<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('customer.bookings.index') }}" :icon="true">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">Booking Detail</h1>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <x-card class="flex flex-col gap-4">
            <p class="text-sm font-semibold text-heading">Vehicle Info</p>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-body-subtle">Brand</span>
                    <span class="text-heading font-medium">{{ $booking->vehicle->brand }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-body-subtle">Model</span>
                    <span class="text-heading font-medium">{{ $booking->vehicle->model }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-body-subtle">Year</span>
                    <span class="text-heading font-medium">{{ $booking->vehicle->year }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-body-subtle">License Plate</span>
                    <span class="text-heading font-medium">{{ $booking->vehicle->license_plate }}</span>
                </div>
            </div>
        </x-card>

        <x-card class="flex flex-col gap-4">
            <p class="text-sm font-semibold text-heading">Booking Info</p>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-body-subtle">Scheduled At</span>
                    <span class="text-heading font-medium">{{ $booking->scheduled_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-body-subtle">Status</span>
                    @php
                        $variants = [
                            'scheduled'   => 'warning',
                            'in_progress' => 'primary',
                            'done'        => 'success',
                            'cancelled'   => 'danger',
                        ];
                    @endphp
                    <x-badge variant="{{ $variants[$booking->status] ?? 'secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </x-badge>
                </div>
                @if($booking->complaint)
                    <div class="flex flex-col gap-1">
                        <span class="text-body-subtle">Complaint</span>
                        <span class="text-heading">{{ $booking->complaint }}</span>
                    </div>
                @endif
            </div>
        </x-card>
    </div>

    <x-card class="flex flex-col gap-4">
        <p class="text-sm font-semibold text-heading">Services</p>
        <table class="w-full text-sm">
            <thead class="bg-neutral-secondary-medium">
                <tr>
                    <th class="px-4 py-2.5 text-left font-semibold text-heading">Service</th>
                    <th class="px-4 py-2.5 text-left font-semibold text-heading">Price</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-default">
                @foreach($booking->services as $bookingService)
                    <tr>
                        <td class="px-4 py-2.5 text-heading">{{ $bookingService->service->name }}</td>
                        <td class="px-4 py-2.5 text-heading">
                            {{ $bookingService->price ? 'Rp ' . number_format($bookingService->price, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>

</x-layouts.dashboard>