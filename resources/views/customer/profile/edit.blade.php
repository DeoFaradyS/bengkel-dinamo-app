<x-layouts.dashboard>

    <h1 class="text-2xl font-bold text-heading">My Profile</h1>

    @if(session('success'))
        <div class="px-4 py-3 text-sm text-fg-success-strong bg-success-soft border border-success-subtle rounded-base">
            {{ session('success') }}
        </div>
    @endif

    <x-card class="w-full">
        <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-4" novalidate>
            @csrf
            @method('PUT')

            <x-forms.input label="Name" name="name" type="text"
                placeholder="e.g. John Doe"
                :value="old('name', $user->name)" required />

            <x-forms.input label="Email" name="email" type="email"
                placeholder="e.g. john@example.com"
                :value="old('email', $user->email)" required />

            <x-forms.input label="Phone Number" name="phone_number" type="text"
                placeholder="e.g. 08123456789"
                :value="old('phone_number', $user->phone_number)" />

            <div class="flex items-center gap-3">
                <x-button type="submit">Save Changes</x-button>
            </div>

        </form>
    </x-card>

</x-layouts.dashboard>