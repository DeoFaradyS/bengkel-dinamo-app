<x-layouts.dashboard>

    <div class="flex items-center justify-between">
        <div class="flex flex-col gap-1">
            <h1 class="text-2xl font-bold text-heading">Categories</h1>
        </div>
        <x-button type="button" data-modal-target="modal-create-category" data-modal-toggle="modal-create-category">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
            </svg>
            Add Category
        </x-button>
    </div>

    <x-table>
        <x-slot:head>
            <tr>
                <x-table.cell head class="w-20 text-center ">No</x-table.cell>
                <x-table.cell head>Name</x-table.cell>
                <x-table.cell head class="w-20"><span class="sr-only">Actions</span></x-table.cell>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse($categories as $category)
                <tr>
                    <x-table.cell class="w-20 text-center">{{ $loop->iteration }}</x-table.cell>
                    <x-table.cell>{{ $category->name }}</x-table.cell>
                    <x-table.cell class="w-20">
                        <button data-dropdown-toggle="dropdown-{{ $category->id }}"
                            class="p-1 text-body-subtle hover:text-body rounded" type="button">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                        </button>
                        <div id="dropdown-{{ $category->id }}"
                            class="hidden z-10 w-40 bg-neutral-primary-soft border border-default rounded-base shadow-xs">
                            <ul class="py-1 text-sm">
                                <li>
                                    <button type="button"
                                        data-modal-target="modal-edit-category"
                                        data-modal-toggle="modal-edit-category"
                                        data-category-id="{{ $category->id }}"
                                        data-category-name="{{ $category->name }}"
                                        data-category-action="{{ route('admin.categories.update', $category) }}"
                                        class="edit-category-btn w-full text-left flex items-center gap-2 px-4 py-2 text-body hover:bg-neutral-tertiary">
                                        <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        Edit
                                    </button>
                                </li>
                                <li>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full text-left flex items-center gap-2 px-4 py-2 text-danger hover:bg-neutral-tertiary">
                                            <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
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
                <x-table.empty message="No categories found." colspan="3" />
            @endforelse
        </x-slot:body>
    </x-table>

    {{-- Modal: Create --}}
    <div id="modal-create-category" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-neutral-primary-soft rounded-base shadow-xs border border-default">
                <div class="flex items-center justify-between p-4 border-b border-default">
                    <h3 class="text-lg font-semibold text-heading">Add Category</h3>
                    <button type="button" data-modal-hide="modal-create-category" class="text-body-subtle hover:text-body">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="p-4 space-y-4">
                    @csrf
                    <x-forms.input label="Category Name" name="name" type="text" placeholder="e.g. Dinamo Starter" required />
                    <div class="flex items-center gap-3">
                        <x-button type="submit">Save Category</x-button>
                        <x-button type="button" variant="secondary" data-modal-hide="modal-create-category">Cancel</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal: Edit (shared, di-isi via JS) --}}
    <div id="modal-edit-category" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-neutral-primary-soft rounded-base shadow-xs border border-default">
                <div class="flex items-center justify-between p-4 border-b border-default">
                    <h3 class="text-lg font-semibold text-heading">Edit Category</h3>
                    <button type="button" data-modal-hide="modal-edit-category" class="text-body-subtle hover:text-body">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <form id="edit-category-form" action="" method="POST" class="p-4 space-y-4">
                    @csrf
                    @method('PUT')
                    <x-forms.input label="Category Name" name="name" id="edit-category-name" type="text" required />
                    <div class="flex items-center gap-3">
                        <x-button type="submit">Update Category</x-button>
                        <x-button type="button" variant="secondary" data-modal-hide="modal-edit-category">Cancel</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-category-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.getElementById('edit-category-form').action = btn.dataset.categoryAction;
                    document.getElementById('edit-category-name').value = btn.dataset.categoryName;
                });
            });
        });
    </script>
    @endpush

</x-layouts.dashboard>