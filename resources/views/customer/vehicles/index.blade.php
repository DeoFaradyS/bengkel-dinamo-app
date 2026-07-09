<x-layouts.dashboard>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-heading">My Vehicles</h1>
        <x-button href="{{ route('customer.vehicles.create') }}">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
            </svg>
            Add Vehicle
        </x-button>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-16">No.</x-table.cell>
                <x-table.cell head>License Plate</x-table.cell>
                <x-table.cell head>Brand</x-table.cell>
                <x-table.cell head>Model</x-table.cell>
                <x-table.cell head>Year</x-table.cell>
                <x-table.cell head><span class="sr-only">Actions</span></x-table.cell>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse($vehicles as $vehicle)
            <tr>
                <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                <x-table.cell>{{ $vehicle->license_plate }}</x-table.cell>
                <x-table.cell>{{ $vehicle->brand }}</x-table.cell>
                <x-table.cell>{{ $vehicle->model }}</x-table.cell>
                <x-table.cell>{{ $vehicle->year }}</x-table.cell>
                <x-table.cell>
                    <button data-dropdown-toggle="dropdown-{{ $vehicle->id }}"
                        class="p-1 text-body-subtle hover:text-body rounded" type="button">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </button>
                    <div id="dropdown-{{ $vehicle->id }}"
                        class="hidden z-10 w-40 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
                        <ul class="py-1 text-sm">
                            <li>
                                <a href="{{ route('customer.vehicles.edit', $vehicle) }}"
                                    class="flex items-center gap-2 px-4 py-2 text-body hover:bg-neutral-tertiary">
                                    <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                    Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('customer.vehicles.destroy', $vehicle) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-left flex items-center gap-2 px-4 py-2 text-danger hover:bg-neutral-tertiary">
                                        <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </x-table.cell>
            </tr>
            @empty
                <x-table.empty message="No vehicles found." colspan="6" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>