<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-espresso shadow-md">

    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 text-peony text-lg font-semibold">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2a4 4 0 0 1 4 4c0 1.5-.8 2.6-2 3.5 1.2.9 2 2 2 3.5a4 4 0 0 1-8 0c0-1.5.8-2.6 2-3.5-1.2-.9-2-2-2-3.5a4 4 0 0 1 4-4z"></path>
                <path d="M12 13v9"></path>
            </svg>
            Nook &amp; Peony
        </a>

        <!-- DESKTOP LINKS -->
        <div class="hidden md:flex items-center gap-6">

            <a href="{{ url('/') }}"
               class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->is('/') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Home
            </a>

            <a href="{{ route('products.index') }}"
               class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->routeIs('products.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 2v7c0 1.1.9 2 2 2h1a2 2 0 0 0 2-2V2"></path>
                    <path d="M6 2v20"></path>
                    <path d="M18 2c-2 0-3 2-3 5s1 5 3 5v10"></path>
                </svg>
                Menu
            </a>

            @auth

                @php
                    $role = auth()->user()->role ? strtolower(auth()->user()->role->name) : null;
                @endphp

                <a href="{{ route('bookings.index') }}"
                   class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->routeIs('bookings.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Bookings
                </a>

                <a href="{{ route('cart.index') }}"
                   class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->routeIs('cart.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    Cart
                </a>

                {{-- Admin Dashboard --}}
                @if($role === 'admin')

                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->routeIs('admin.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6z"></path>
                        </svg>
                        Admin Dashboard
                    </a>

                {{-- Staff Dashboard --}}
                @elseif($role === 'staff')

                    <a href="{{ route('staff.dashboard') }}"
                       class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->routeIs('staff.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Staff Dashboard
                    </a>

                @endif

                <div class="h-5 w-px bg-peony/20"></div>

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-1.5 text-sm hover:opacity-80 transition {{ request()->routeIs('profile.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="flex items-center gap-1.5 bg-peony text-espresso text-sm font-medium px-4 py-2 rounded-lg hover:opacity-90 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log out
                    </button>
                </form>

            @else

                <a href="{{ route('login') }}"
                   class="text-sm hover:opacity-80 transition {{ request()->routeIs('login') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                    Sign in
                </a>

                <a href="{{ route('register') }}"
                   class="bg-peony text-espresso text-sm font-medium px-4 py-2 rounded-lg hover:opacity-90 transition">
                    Sign up
                </a>

            @endauth

        </div>

        <!-- MOBILE TOGGLE -->
        <button @click="open = !open" class="md:hidden text-peony" aria-label="Toggle menu">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
            <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" x-cloak x-transition class="md:hidden border-t border-peony/20 px-6 py-4 space-y-4">

        <a href="{{ url('/') }}" class="block text-sm {{ request()->is('/') ? 'text-peony font-semibold' : 'text-peony/80' }}">
            Home
        </a>

        <a href="{{ route('products.index') }}" class="block text-sm {{ request()->routeIs('products.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
            Menu
        </a>

        @auth

            @php
                $role = auth()->user()->role ? strtolower(auth()->user()->role->name) : null;
            @endphp

            <a href="{{ route('bookings.index') }}" class="block text-sm {{ request()->routeIs('bookings.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                Bookings
            </a>

            <a href="{{ route('cart.index') }}" class="block text-sm {{ request()->routeIs('cart.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                Cart
            </a>

            @if($role === 'admin')

                <a href="{{ route('admin.dashboard') }}" class="block text-sm {{ request()->routeIs('admin.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                    Admin Dashboard
                </a>

            @elseif($role === 'staff')

                <a href="{{ route('staff.dashboard') }}" class="block text-sm {{ request()->routeIs('staff.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                    Staff Dashboard
                </a>

            @endif

            <a href="{{ route('profile.edit') }}" class="block text-sm {{ request()->routeIs('profile.*') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full text-left bg-peony text-espresso text-sm font-medium px-4 py-2 rounded-lg hover:opacity-90 transition">
                    Log out
                </button>
            </form>

        @else

            <a href="{{ route('login') }}" class="block text-sm {{ request()->routeIs('login') ? 'text-peony font-semibold' : 'text-peony/80' }}">
                Sign in
            </a>

            <a href="{{ route('register') }}"
               class="inline-block bg-peony text-espresso text-sm font-medium px-4 py-2 rounded-lg hover:opacity-90 transition">
                Sign up
            </a>

        @endauth

    </div>

</nav>