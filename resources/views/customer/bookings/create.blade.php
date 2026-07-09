<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('customer.bookings.index') }}" :icon="true">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">New Booking</h1>
    </div>

    <x-card class="w-full">
        <form action="{{ route('customer.bookings.store') }}" method="POST" class="space-y-4" novalidate>
            @csrf

            {{-- Vehicle --}}
            <div>
                <label class="block mb-2.5 text-sm font-semibold text-heading">
                    Vehicle <span class="text-danger">*</span>
                </label>
                <select name="vehicle_id"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                    <option value="">Select Vehicle</option>
                    @forelse($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->brand }} {{ $vehicle->model }} - {{ $vehicle->license_plate }}
                        </option>
                    @empty
                        <option value="" disabled>Belum ada kendaraan aktif</option>
                    @endforelse
                </select>
                @error('vehicle_id')
                    <p class="mt-2.5 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            {{-- Scheduled At --}}
            <x-forms.input label="Scheduled At" name="scheduled_at" type="datetime-local"
                :value="old('scheduled_at')" min="{{ now()->format('Y-m-d\TH:i') }}" required />

            {{-- Services --}}
            <div>
                <label class="block mb-2.5 text-sm font-semibold text-heading">
                    Services <span class="text-danger">*</span>
                </label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($services as $service)
                        <label class="flex items-start gap-3 p-3 border border-default rounded-base cursor-pointer hover:bg-neutral-secondary-medium has-[:checked]:border-brand has-[:checked]:bg-brand-soft">
                            <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                                {{ in_array($service->id, old('service_ids', [])) ? 'checked' : '' }}
                                class="mt-0.5 rounded text-brand focus:ring-brand">
                            <div>
                                <p class="text-sm font-medium text-heading">{{ $service->name }}</p>
                                <p class="text-xs text-body-subtle">Rp {{ number_format($service->price_min, 0, ',', '.') }} - Rp {{ number_format($service->price_max, 0, ',', '.') }}</p>
                                <p class="text-xs text-body-subtle">{{ $service->estimated_time_minutes }} min</p>
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('service_ids')
                    <p class="mt-2.5 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            {{-- Complaint --}}
            <div>
                <label class="block mb-2.5 text-sm font-semibold text-heading">Complaint</label>
                <textarea name="complaint" rows="3" placeholder="Describe your complaint..."
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body">{{ old('complaint') }}</textarea>
                @error('complaint')
                    <p class="mt-2.5 text-sm text-fg-danger-strong">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <x-button type="submit">Submit Booking</x-button>
                <x-button variant="secondary" href="{{ route('customer.bookings.index') }}">Cancel</x-button>
            </div>

        </form>
    </x-card>

</x-layouts.dashboard>