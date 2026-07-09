<x-layouts.dashboard>

    <h1 class="text-2xl font-bold text-heading">Revenue Report</h1>

    {{-- Filter --}}
    <x-card>
        <form method="GET" action="{{ route('admin.reports.revenue') }}" class="flex items-end gap-4">
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
    <div class="grid grid-cols-3 gap-6">
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Services Revenue</p>
            <p class="text-3xl font-semibold text-fg-default">Rp {{ number_format($totalServices, 0, ',', '.') }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Spare Parts Revenue</p>
            <p class="text-3xl font-semibold text-fg-default">Rp {{ number_format($totalSpareParts, 0, ',', '.') }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Total Revenue</p>
            <p class="text-3xl font-semibold text-fg-success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </x-card>
    </div>

    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-16">No.</x-table.cell>
                <x-table.cell head>Customer</x-table.cell>
                <x-table.cell head>Vehicle</x-table.cell>
                <x-table.cell head>Scheduled At</x-table.cell>
                <x-table.cell head>Services</x-table.cell>
                <x-table.cell head>Spare Parts</x-table.cell>
                <x-table.cell head>Total</x-table.cell>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @forelse($bookings as $booking)
                @php
                    $servicesTotal   = $booking->services->sum('price');
                    $sparePartsTotal = $booking->spareParts->sum(fn($sp) => $sp->price * $sp->quantity);
                @endphp
                <tr>
                    <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $booking->user->name }}</x-table.cell>
                    <x-table.cell>{{ $booking->vehicle->brand }} {{ $booking->vehicle->model }}</x-table.cell>
                    <x-table.cell>{{ $booking->scheduled_at->format('d M Y') }}</x-table.cell>
                    <x-table.cell>Rp {{ number_format($servicesTotal, 0, ',', '.') }}</x-table.cell>
                    <x-table.cell>Rp {{ number_format($sparePartsTotal, 0, ',', '.') }}</x-table.cell>
                    <x-table.cell>Rp {{ number_format($servicesTotal + $sparePartsTotal, 0, ',', '.') }}</x-table.cell>
                </tr>
            @empty
                <x-table.empty message="No revenue data found." colspan="7" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>