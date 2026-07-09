<x-layouts.app :title="$title ?? null">

    <x-navbar.dashboard />

    <div class="flex">
        <x-sidebar />

        <div class="flex-1 p-6 flex flex-col gap-6">
            {{ $slot }}
        </div>
    </div>

    <div class="fixed bottom-4 right-4 z-50 flex flex-col gap-2">
        @if(session('success'))
            <x-toast variant="success" :message="session('success')" />
        @endif
        @if(session('error'))
            <x-toast variant="danger" :message="session('error')" />
        @endif
        @if(session('warning'))
            <x-toast variant="warning" :message="session('warning')" />
        @endif
    </div>

</x-layouts.app>