<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('admin.services.index') }}" :icon="true">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m15 19-7-7 7-7" />
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">Create Service</h1>
    </div>

    <x-card class="w-full">
        <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4" novalidate>
            @csrf

            <x-forms.input label="Service Name" name="name" type="text" placeholder="e.g. Oil Change"
                :error="$errors->first('name')" required />

            <div class="flex gap-4">
                <div class="w-1/2">
                    <x-forms.input label="Min Price" name="price_min" type="number" placeholder="e.g. 100000"
                        :error="$errors->first('price_min')" required />
                </div>
                <div class="w-1/2">
                    <x-forms.input label="Max Price" name="price_max" type="number" placeholder="e.g. 100000"
                        :error="$errors->first('price_max')" required />
                </div>
            </div>

            <x-forms.input label="Estimated Time (minutes)" name="estimated_time_minutes" type="number"
                placeholder="e.g. 30" :error="$errors->first('estimated_time_minutes')" required />

            <div class="flex items-center gap-4">
                <x-button type="submit">Save Service</x-button>
                <x-button variant="secondary" href="{{ route('admin.services.index') }}">Cancel</x-button>
            </div>

        </form>
    </x-card>

</x-layouts.dashboard>