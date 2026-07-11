<aside id="separator-sidebar"
    class="w-60 h-screen sticky shrink-0 top-0 transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-4 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default flex flex-col">

        <div class="flex-1">
            <ul class="space-y-2 font-medium">

                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.dashboard') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <li>
                    <hr class="my-2 border-default">
                </li>

                <li>
                    <a href="{{ route('admin.bookings.index') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.bookings.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                        </svg>
                        <span class="ms-3">Bookings</span>
                    </a>
                </li>
                {{-- Services --}}
                <li>
                    <a href="{{ route('admin.services.index') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.services.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.52-1.446 1.06L12 17.16a1 1 0 0 0-1.066 0l-3.945 2.394c-.736.46-1.66-.202-1.447-1.06l1.03-4.119a1 1 0 0 0-.337-1.016l-3.33-2.723c-.699-.571-.344-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.752-4.022Z" />
                        </svg>
                        <span class="ms-3">Services</span>
                    </a>
                </li>

                <li>
                    <hr class="my-2 border-default">
                </li>

                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.categories.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.5 11.5 11 13l4-3.5M12 20H5.5a1.5 1.5 0 0 1 0-3h.5a1.5 1.5 0 0 0 0-3H4a1.5 1.5 0 0 1 0-3h.5a1.5 1.5 0 0 0 0-3H3m10 1h4a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z" />
                        </svg>
                        <span class="ms-3">Categories</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.spare-parts.index') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.spare-parts.*') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                        </svg>
                        <span class="ms-3">Spare Parts</span>
                    </a>
                </li>

                <li>
                    <hr class="my-2 border-default">
                </li>

                <li>
                    <a href="{{ route('admin.reports.booking') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.reports.booking') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                        </svg>
                        <span class="ms-3">Booking Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports.revenue') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.reports.revenue') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                        </svg>
                        <span class="ms-3">Revenue Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports.stock') }}"
                        class="flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ request()->routeIs('admin.reports.stock') ? 'bg-neutral-tertiary text-fg-brand' : '' }}">
                        <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 10V6a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v4m3-2 .917 11.923A1 1 0 0 1 17.92 21H6.08a1 1 0 0 1-.997-1.077L6 8h12Z" />
                        </svg>
                        <span class="ms-3">Stock Report</span>
                    </a>
                </li>

            </ul>
        </div>

        {{-- Logout, pinned bottom --}}
        <div class="mt-2 pt-2 border-t border-default">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center px-2 py-1.5 text-sm text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 17l5-5-5-5M21 12H9m4 9H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8" />
                    </svg>
                    <span class="ms-3">Log Out</span>
                </button>
            </form>
        </div>

    </div>
</aside>