<x-layouts.app>

    <section class="min-h-screen flex items-center justify-center">

        <x-card class="w-md flex flex-col gap-8">

            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                Sign in to your account
            </h1>

            <form class="space-y-4" action="{{ route('login.post') }}" method="POST" novalidate>
                @csrf

                <x-forms.input label="Email" name="email" type="email" placeholder="example@gmail.com"
                    :error="$errors->first('email')" required />

                <x-forms.input label="Password" name="password" type="password" placeholder="•••••••••"
                    :error="$errors->first('password')" required />

                <x-button type="submit" variant="primary" class="w-full">
                    Sign In
                </x-button>

            </form>

        </x-card>

    </section>

</x-layouts.app>