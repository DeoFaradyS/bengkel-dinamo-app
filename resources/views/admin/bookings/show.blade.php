<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('admin.bookings.index') }}" :icon="true">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">Booking Detail</h1>
    </div>

    <div class="grid grid-cols-2 gap-6">
        {{-- Customer Info --}}
        <x-card class="flex flex-col gap-4">
            <p class="text-sm font-semibold text-heading">Customer Info</p>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-body-subtle">Name</span>
                    <span class="text-heading font-medium">{{ $booking->customer_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-body-subtle">Phone</span>
                    <span class="text-heading font-medium">{{ $booking->customer_phone }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-body-subtle">Service Type</span>
                    <span class="text-heading font-medium">{{ ucfirst(str_replace('_', ' ', $booking->service_type)) }}</span>
                </div>
                @if($booking->service_type === 'home_service')
                    <div class="flex justify-between">
                        <span class="text-body-subtle">Address</span>
                        <span class="text-heading font-medium">{{ $booking->customer_address }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-body-subtle">Distance</span>
                        <span class="text-heading font-medium">{{ $booking->distance_km }} km</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-body-subtle">Home Service Fee</span>
                        <span class="text-heading font-medium">Rp {{ number_format($booking->home_service_fee, 0, ',', '.') }}</span>
                    </div>
                @endif
            </div>
        </x-card>

        {{-- Vehicle Info --}}
        <x-card class="flex flex-col gap-4">
            <p class="text-sm font-semibold text-heading">Vehicle Info</p>
            @if($booking->vehicle)
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-body-subtle">Model</span>
                        <span class="text-heading font-medium">{{ $booking->vehicle->vehicle_model }}</span>
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
            @else
                <p class="text-sm text-body-subtle">Tidak ada data kendaraan.</p>
            @endif
        </x-card>
    </div>

    <div class="grid grid-cols-2 gap-6">
        {{-- Booking Info & Status --}}
        <x-card class="flex flex-col gap-4">
            <p class="text-sm font-semibold text-heading">Booking Info</p>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-body-subtle">Scheduled At</span>
                    <span class="text-heading font-medium">{{ $booking->scheduled_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-body-subtle">Status</span>
                    @php
                        $variants = [
                            'pending'     => 'warning',
                            'approved'    => 'brand',
                            'in_progress' => 'brand',
                            'done'        => 'success',
                            'cancelled'   => 'gray',
                            'rejected'    => 'danger',
                        ];
                    @endphp
                    <x-badge variant="{{ $variants[$booking->status] ?? 'gray' }}">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </x-badge>
                </div>
                @if($booking->status === 'rejected' && $booking->rejection_reason)
                    <div class="flex flex-col gap-1">
                        <span class="text-body-subtle">Rejection Reason</span>
                        <span class="text-heading">{{ $booking->rejection_reason }}</span>
                    </div>
                @endif
                @if($booking->complaint)
                    <div class="flex flex-col gap-1">
                        <span class="text-body-subtle">Complaint</span>
                        <span class="text-heading">{{ $booking->complaint }}</span>
                    </div>
                @endif
            </div>

            {{-- Approve / Reject (pending only) --}}
            @if($booking->status === 'pending')
                <div class="flex items-center gap-3 pt-2 border-t border-default">
                    <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                        @csrf
                        <x-button type="submit">Approve</x-button>
                    </form>
                    <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="text" name="rejection_reason" placeholder="Alasan reject" required
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2 shadow-xs">
                        <x-button type="submit" variant="tertiary">Reject</x-button>
                    </form>
                </div>
            @endif

            {{-- Update Status (approved onward) --}}
            @if(!in_array($booking->status, ['pending', 'done', 'cancelled', 'rejected']))
                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="flex items-center gap-3 pt-2 border-t border-default">
                    @csrf
                    @method('PUT')
                    <select name="status"
                        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2 shadow-xs flex-1">
                        <option value="approved" {{ $booking->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="in_progress" {{ $booking->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $booking->status === 'done' ? 'selected' : '' }}>Done</option>
                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <x-button type="submit">Update</x-button>
                </form>
            @endif
        </x-card>

        {{-- Add Spare Part --}}
        <x-card class="flex flex-col gap-4">
            <p class="text-sm font-semibold text-heading">Add Spare Part</p>
            @if(!in_array($booking->status, ['done', 'cancelled', 'rejected']))
                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block mb-2.5 text-sm font-semibold text-heading">Spare Part</label>
                        <select name="spare_part_stock_id"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="">Select Spare Part</option>
                            @foreach($sparePartStocks as $stock)
                                <option value="{{ $stock->id }}">
                                    {{ $stock->sparePart->name }} ({{ ucfirst($stock->condition) }}) - Stok: {{ $stock->stock }} - Rp {{ number_format($stock->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-forms.input label="Quantity" name="quantity" type="number" placeholder="e.g. 2" />
                    <x-button type="submit">Add</x-button>
                </form>
            @else
                <p class="text-sm text-body-subtle">Booking sudah {{ $booking->status }}, tidak bisa menambah spare part.</p>
            @endif
        </x-card>
    </div>

    {{-- Services --}}
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

    {{-- Spare Parts --}}
    <x-card class="flex flex-col gap-4">
        <p class="text-sm font-semibold text-heading">Spare Parts Used</p>
        @if($booking->spareParts->isEmpty())
            <p class="text-sm text-body-subtle">No spare parts added yet.</p>
        @else
            <table class="w-full text-sm">
                <thead class="bg-neutral-secondary-medium">
                    <tr>
                        <th class="px-4 py-2.5 text-left font-semibold text-heading">Spare Part</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-heading">Condition</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-heading">Qty</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-heading">Price</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-heading">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-default">
                    @foreach($booking->spareParts as $sparePart)
                        <tr>
                            <td class="px-4 py-2.5 text-heading">{{ $sparePart->sparePartStock->sparePart->name }}</td>
                            <td class="px-4 py-2.5 text-heading capitalize">{{ $sparePart->sparePartStock->condition }}</td>
                            <td class="px-4 py-2.5 text-heading">{{ $sparePart->quantity }}</td>
                            <td class="px-4 py-2.5 text-heading">Rp {{ number_format($sparePart->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2.5 text-heading">Rp {{ number_format($sparePart->price * $sparePart->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-card>

</x-layouts.dashboard>