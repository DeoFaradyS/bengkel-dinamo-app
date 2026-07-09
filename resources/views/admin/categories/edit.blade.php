<x-layouts.dashboard>

    <div class="flex flex-row items-center gap-4">
        <x-button variant="tertiary" href="{{ route('admin.categories.index') }}" :icon="true">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </x-button>
        <h1 class="text-2xl font-bold text-heading">Edit Category</h1>
    </div>

    <x-card class="w-full">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4" novalidate>
            @csrf
            @method('PUT')
            <x-forms.input label="Category Name" name="name" type="text"
                placeholder="e.g. Engine" :value="old('name', $category->name)" required />
            <div class="flex items-center gap-3">
                <x-button type="submit">Update Category</x-button>
                <x-button variant="secondary" href="{{ route('admin.categories.index') }}">Cancel</x-button>
            </div>
        </form>
    </x-card>

</x-layouts.dashboard>