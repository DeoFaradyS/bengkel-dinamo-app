<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('customer.vehicles.index') }}" :icon="true">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">Edit Vehicle</h1>
    </div>

    <x-card class="w-full">
        <form action="{{ route('customer.vehicles.update', $vehicle) }}" method="POST" class="space-y-4" novalidate>
            @csrf
            @method('PUT')

            <div class="flex gap-4">
                <div class="w-1/2">
                    <x-forms.input label="License Plate" name="license_plate" type="text"
                        placeholder="e.g. B 1234 ABC"
                        :value="old('license_plate', $vehicle->license_plate)" required />
                </div>
                <div class="w-1/2">
                    <x-forms.input label="Year" name="year" type="number"
                        placeholder="e.g. 2020"
                        :value="old('year', $vehicle->year)" required />
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    <x-forms.input label="Brand" name="brand" type="text"
                        placeholder="e.g. Toyota"
                        :value="old('brand', $vehicle->brand)" required />
                </div>
                <div class="w-1/2">
                    <x-forms.input label="Model" name="model" type="text"
                        placeholder="e.g. Avanza"
                        :value="old('model', $vehicle->model)" required />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-button type="submit">Update Vehicle</x-button>
                <x-button variant="secondary" href="{{ route('customer.vehicles.index') }}">Cancel</x-button>
            </div>

        </form>
    </x-card>

</x-layouts.dashboard>
