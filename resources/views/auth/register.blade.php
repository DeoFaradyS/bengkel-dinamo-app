<x-layouts.app>

    <section class="min-h-screen flex items-center justify-center">

        <x-card class="w-md flex flex-col gap-8">

            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-center">
                Create an account
            </h1>

            <form class="space-y-4" action="{{ route('register.post') }}" method="POST" novalidate>
                @csrf

                <x-forms.input label="Name" name="name" type="text" placeholder="John Doe" required />

                <x-forms.input label="Email" name="email" type="email" placeholder="example@gmail.com"
                    :error="$errors->first('email')" required />

                <x-forms.input label="Password" name="password" type="password" placeholder="•••••••••"
                    :error="$errors->first('password')" required />

                <x-forms.input label="Confirm Password" name="password_confirmation" type="password" placeholder="•••••••••"
                    :error="$errors->first('password')" required />

                <x-button type="submit" variant="primary" class="w-full">
                    Create an account
                </x-button>

            </form>

            <p class="text-sm font-reguler text-gray-500 text-center">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline">Login Here</a>
            </p>

        </x-card>

    </section>

</x-layouts.app>