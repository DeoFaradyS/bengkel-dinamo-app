<x-layouts.dashboard>
    <div class="grid grid-cols-5 gap-y-4 gap-x-4">

        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Pending Approval</p>
            <p class="text-3xl font-semibold text-warning">{{ $pendingApproval }}</p>
        </x-card>

        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Bookings Hari Ini</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $todayBookings }}</p>
        </x-card>

        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Revenue Hari Ini</p>
            <p class="text-3xl font-semibold text-fg-default">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </x-card>

        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Total Customer</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $totalCustomers }}</p>
        </x-card>

        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Stok Menipis</p>
            <p class="text-3xl font-semibold text-danger">{{ $lowStock }}</p>
        </x-card>

    </div>

    <x-card>
        <p class="text-lg font-semibold text-heading mb-4">Bookings 7 Hari Terakhir</p>
        <div id="chart-bookings"></div>
    </x-card>

    @pushonce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const options = {
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: { show: false },
                    fontFamily: 'inherit',
                },
                series: [{
                    name: 'Bookings',
                    data: {!! $chartData->pluck('count') !!}
                }],
                xaxis: {
                    categories: {!! $chartData->pluck('date') !!},
                    labels: {
                        style: { colors: '#888780', fontSize: '12px' }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                },
                yaxis: {
                    labels: {
                        style: { colors: '#888780', fontSize: '12px' }
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '50%',
                    }
                },
                colors: ['#378ADD'],
                grid: {
                    borderColor: '#e5e7eb',
                    strokeDashArray: 4,
                },
                dataLabels: { enabled: false },
                tooltip: {
                    y: {
                        formatter: val => val + ' booking'
                    }
                }
            }

            const chart = new ApexCharts(document.getElementById('chart-bookings'), options)
            chart.render()
        });
    </script>
    @endpushonce

    <x-table>
        <x-slot:toolbar>
            <p class="text-lg font-semibold text-heading">Booking Terbaru</p>
            <p class="mt-1 text-sm text-body-subtle">5 booking terakhir yang masuk.</p>
        </x-slot:toolbar>
        <x-slot:head>
            <tr>
                <x-table.cell head>Customer</x-table.cell>
                <x-table.cell head>Kendaraan</x-table.cell>
                <x-table.cell head>Jadwal</x-table.cell>
                <x-table.cell head>Status</x-table.cell>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @foreach($recentBookings as $booking)
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
                    <x-table.cell>{{ $booking->customer_name }}</x-table.cell>
                    <x-table.cell>{{ $booking->vehicle?->license_plate ?? '-' }} {{ $booking->vehicle?->vehicle_model }}</x-table.cell>
                    <x-table.cell>{{ $booking->scheduled_at->format('d M Y, H:i') }}</x-table.cell>
                    <x-table.cell>
                        <x-badge variant="{{ $variants[$booking->status] ?? 'gray' }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </x-badge>
                    </x-table.cell>
                </tr>
            @endforeach
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>