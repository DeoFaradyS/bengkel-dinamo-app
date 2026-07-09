<x-layouts.dashboard>

    {{-- Header --}}
    <div class="flex flex-col gap-1">   
        <h1 class="text-2xl font-bold text-heading">Users</h1>
    </div>

    {{-- Cards --}}
    <div class="grid grid-cols-3 gap-6">
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Total Users</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $total }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Active Users</p>
            <p class="text-3xl font-semibold text-fg-default">{{ $aktif }}</p>
        </x-card>
        <x-card class="flex flex-col gap-2">
            <p class="text-sm font-medium text-body-subtle">Inactive Users</p>
            <p class="text-3xl font-semibold text-danger">{{ $nonaktif }}</p>
        </x-card>
    </div>

    {{-- Tabel --}}
    <x-table>
        <x-slot:toolbar>
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    {{-- Search --}}
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-body-subtle" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Search users..."
                            class="text-sm pl-9 pr-4 py-2 border border-default rounded-base bg-neutral-primary-soft text-body placeholder:text-body-subtle focus:outline-none focus:ring-1 focus:ring-brand">
                    </div>

                    {{-- Filter Status --}}
                    <select
                        class="text-sm px-3 py-2 border border-default rounded-base bg-neutral-primary-soft text-body focus:outline-none focus:ring-1 focus:ring-brand">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </x-slot:toolbar>

        <x-slot:head>
            <tr>
                <x-table.cell head class="w-20 text-center">No</x-table.cell>
                <x-table.cell head>Name</x-table.cell>
                <x-table.cell head>Email</x-table.cell>
                <x-table.cell head>Phone Number</x-table.cell>
                <x-table.cell head>Status</x-table.cell>
                <x-table.cell head class="w-20"><span class="sr-only">Actions</span></x-table.cell>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse($customers as $customer)
                <tr>
                    <x-table.cell class="w-20 text-center">{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $customer->name }}</x-table.cell>
                    <x-table.cell>{{ $customer->email }}</x-table.cell>
                    <x-table.cell>{{ $customer->phone_number ?? '-' }}</x-table.cell>
                    <x-table.cell>
                        <x-badge variant="{{ $customer->is_active ? 'success' : 'danger' }}">
                            {{ $customer->is_active ? 'Active' : 'Inactive' }}
                        </x-badge>
                    </x-table.cell>
                    <x-table.cell>
                        <button data-dropdown-toggle="dropdown-{{ $customer->id }}"
                            class="p-1 text-body-subtle hover:text-body rounded" type="button">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                        <div id="dropdown-{{ $customer->id }}"
                            class="hidden z-10 w-40 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
                            <ul class="py-1 text-sm">
                                <li>
                                    <form action="{{ route('admin.users.update', $customer) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="{{ $customer->is_active ? 0 : 1 }}">
                                        <button type="submit"
                                            class="w-full text-left flex items-center gap-2 px-4 py-2 hover:bg-neutral-tertiary {{ $customer->is_active ? 'text-danger' : 'text-body' }}">
                                            @if($customer->is_active)
                                                <svg class="w-4 h-4 shrink-0" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                        d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Deactivate
                                            @else
                                                <svg class="w-4 h-4 shrink-0" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
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
                <x-table.empty message="No users found." colspan="6" />
            @endforelse
        </x-slot:body>
    </x-table>

</x-layouts.dashboard>