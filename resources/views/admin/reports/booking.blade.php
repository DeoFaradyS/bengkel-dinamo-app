<x-layouts.dashboard>

    <h1 class="text-2xl font-bold text-heading">Booking Report</h1>

    {{-- Filter --}}
    <x-card>
        <form method="GET" action="{{ route('admin.reports.booking') }}" class="flex items-end gap-4">
            <div>
                <label class="block mb-2.5 text-sm font-semibold text-heading">Month</label>
                <select name="month"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2.5 text-sm font-semibold text-heading">Year</label>
                <select name="year"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs">
                    @foreach(range(now()->year - 2, now()->year) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <x-button type="submit">Filter</x-button>
        </form>
    </x-card>

    {{-- Summary --}}
    <div class="grid grid-cols-6 gap-6">
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Total</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $total }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Pending</p>
            <p class="text-3xl font-semibold text-warning">{{ $pending }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Approved</p>
            <p class="text-3xl font-semibold text-fg-brand">{{ $approved }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">In Progress</p>
            <p class="text-3xl font-semibold text-fg-brand">{{ $in_progress }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Done</p>
            <p class="text-3xl font-semibold text-fg-success">{{ $done }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Cancelled</p>
            <p class="text-3xl font-semibold text-danger">{{ $cancelled }}</p>
        </x-card>
    </div>

    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-16">No.</x-table.cell>
                <x-table.cell head>Customer</x-table.cell>
                <x-table.cell head>Vehicle</x-table.cell>
                <x-table.cell head>Services</x-table.cell>
                <x-table.cell head>Scheduled At</x-table.cell>
                <x-table.cell head>Status</x-table.cell>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @forelse($bookings as $booking)
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
                <tr>
                    <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $booking->customer_name }}</x-table.cell>
                    <x-table.cell>{{ $booking->vehicle?->vehicle_model }} - {{ $booking->vehicle?->license_plate ?? '-' }}</x-table.cell>
                    <x-table.cell>
                        <div class="flex flex-wrap gap-1">
                            @foreach($booking->services as $bookingService)
                                <x-badge variant="gray">{{ $bookingService->service->name }}</x-badge>
                            @endforeach
                        </div>
                    </x-table.cell>
                    <x-table.cell>{{ $booking->scheduled_at->format('d M Y, H:i') }}</x-table.cell>
                    <x-table.cell>
                        <x-badge variant="{{ $variants[$booking->status] ?? 'gray' }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </x-badge>
                    </x-table.cell>
                </tr>
            @empty
                <x-table.empty message="No bookings found." colspan="6" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>