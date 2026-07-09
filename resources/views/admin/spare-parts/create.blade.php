<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('admin.spare-parts.index') }}" :icon="true">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">Add Spare Part</h1>
    </div>

    <x-card class="w-full">
        <form action="{{ route('admin.spare-parts.store') }}" method="POST" class="space-y-4" novalidate>
            @csrf

            <div class="flex gap-4">
                <div class="w-1/2">
                    <x-forms.input label="Name" name="name" type="text"
                        placeholder="e.g. Brake Pad" required />
                </div>
                <div class="w-1/2">
                    <x-forms.input label="Part Number" name="part_number" type="text"
                        placeholder="e.g. BP-1234" required />
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    <x-forms.input label="Brand" name="brand" type="text"
                        placeholder="e.g. Bosch" required />
                </div>
                <div class="w-1/2">
                    <x-forms.input label="Unit" name="unit" type="text"
                        placeholder="e.g. pcs" required />
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-1/2">
                    {{-- Category Select --}}
                    <div>
                        <label class="block mb-2.5 text-sm font-semibold text-heading">
                            Category <span class="text-danger">*</span>
                        </label>
                        <select name="category_id"
                            class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2.5 text-sm text-fg-danger-strong">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="w-1/2">
                    <x-forms.input label="Minimum Stock" name="stock_minimum" type="number"
                        placeholder="e.g. 5" required />
                </div>
            </div>

            {{-- Stock --}}
            <div>
                <p class="text-sm font-semibold text-heading mb-3">Stock</p>
                <div class="border border-default rounded-base overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-neutral-secondary-medium">
                            <tr>
                                <th class="px-4 py-2.5 text-left font-semibold text-heading">Condition</th>
                                <th class="px-4 py-2.5 text-left font-semibold text-heading">Stock</th>
                                <th class="px-4 py-2.5 text-left font-semibold text-heading">Price</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-default">
                            @foreach(['new', 'used'] as $condition)
                                <tr>
                                    <td class="px-4 py-2.5 font-medium text-heading capitalize">{{ $condition }}</td>
                                    <td class="px-4 py-2.5">
                                        <x-forms.input name="stocks[{{ $condition }}][stock]" type="number" placeholder="0" />
                                    </td>
                                    <td class="px-4 py-2.5">
                                        <x-forms.input name="stocks[{{ $condition }}][price]" type="number" placeholder="0" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-button type="submit">Save Spare Part</x-button>
                <x-button variant="secondary" href="{{ route('admin.spare-parts.index') }}">Cancel</x-button>
            </div>

        </form>
    </x-card>

</x-layouts.dashboard>