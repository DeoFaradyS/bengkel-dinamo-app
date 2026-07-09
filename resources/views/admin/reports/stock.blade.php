<x-layouts.dashboard>

    <h1 class="text-2xl font-bold text-heading">Stock Report</h1>

    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-16">No.</x-table.cell>
                <x-table.cell head>Spare Part</x-table.cell>
                <x-table.cell head>Category</x-table.cell>
                <x-table.cell head>Condition</x-table.cell>
                <x-table.cell head>Stock</x-table.cell>
                <x-table.cell head>Minimum</x-table.cell>
                <x-table.cell head>Status</x-table.cell>
            </tr>
        </x-slot:head>
        <x-slot:body>
            @forelse($stocks as $stock)
                <tr>
                    <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $stock->sparePart->name }}</x-table.cell>
                    <x-table.cell>{{ $stock->sparePart->category->name }}</x-table.cell>
                    <x-table.cell class="capitalize">{{ $stock->condition }}</x-table.cell>
                    <x-table.cell>{{ $stock->stock }}</x-table.cell>
                    <x-table.cell>{{ $stock->sparePart->stock_minimum }}</x-table.cell>
                    <x-table.cell>
                        <x-badge variant="{{ $stock->stock == 0 ? 'danger' : 'warning' }}">
                            {{ $stock->stock == 0 ? 'Out of Stock' : 'Low Stock' }}
                        </x-badge>
                    </x-table.cell>
                </tr>
            @empty
                <x-table.empty message="All stocks are sufficient." colspan="7" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>