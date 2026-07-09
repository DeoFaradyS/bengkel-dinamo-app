<nav class=" w-full bg-neutral-primary-soft border-b border-default">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">

            {{-- Logo + Hamburger --}}
            <div class="flex items-center justify-start">
                <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar"
                    aria-controls="separator-sidebar" type="button"
                    class="sm:hidden text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base text-sm p-2 focus:outline-none">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h10" />
                    </svg>
                </button>

                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <img src="{{ asset('images/logo.png') }}" alt="Bengkel Dinamo" class="h-12 w-auto">
                </a>

            </div>

            {{-- Profile Dropdown --}}
            <div class="flex items-center ms-3">
                <button type="button"
                    class="flex items-center justify-center w-8 h-8 rounded-full bg-brand text-white text-sm font-semibold focus:ring-4 focus:ring-neutral-tertiary"
                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                    <span class="sr-only">Open user menu</span>
                    {{ strtoupper(substr($name, 0, 1)) }}
                </button>

                <div class="z-50 hidden bg-neutral-primary-soft border border-default rounded-base shadow-xs w-48"
                    id="dropdown-user">

                    {{-- User Info --}}
                    <div class="px-3 py-2.5 border-b border-default">
                        <p class="text-sm font-medium text-heading">{{ $name }}</p>
                        <p class="text-xs text-body truncate">{{ $email }}</p>
                    </div>

                    {{-- Menu --}}
                    <ul class="p-1.5 space-y-0.5">
                        <li>
                            <a href="#"
                                class="inline-flex items-center w-full px-2 py-1.5 text-sm text-body hover:bg-neutral-secondary-medium hover:text-heading rounded-base">
                                Edit Profile
                            </a>
                        </li>
                    </ul>

                    {{-- Logout --}}
                    <div class="border-t border-default p-1.5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center w-full px-2 py-1.5 text-sm text-fg-danger-strong hover:bg-danger-soft rounded-base">
                                Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</nav>