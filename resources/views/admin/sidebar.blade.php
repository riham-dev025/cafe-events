 <aside class="w-64 bg-white border-r border-peony/20 flex flex-col justify-between shrink-0">
        <div>
            <!-- Logo Section -->
            <div class="p-6 border-b border-peony/10 flex items-center gap-3">
                <div class="h-10 w-10 bg-peony/20 rounded-xl flex items-center justify-center text-espresso">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c1 2-1 3-1 5a3 3 0 106 0c0-2-2-3-1-5-3 0-4 2-4 5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 13h9a3 3 0 013 3 3 3 0 01-3 3H8a3 3 0 01-3-3v-3z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-espresso text-base tracking-tight">Nook &amp; Peony</h2>
                    <span class="text-xs text-espresso/40">RestroPanel v1.0</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V10m6 9V5m6 14v-7" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{route('admin.orders.index')}}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 12H7L6 8zM9 8V6a3 3 0 116 0v2" />
                    </svg>
                    Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13c3-6 13-6 16 0-2 1-4 1.5-8 1.5S6 14 4 13z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 13.5V17m8-3.5V17" />
                    </svg>
                    Products
                </a>
                <a href="{{ route('admin.events.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <rect x="4" y="5" width="16" height="15" rx="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 9h16M8 3v3m8-3v3" />
                    </svg>
                    Events
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.bookings.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12v16l-6-4-6 4V4z" />
                    </svg>
                    Bookings
                </a>
                <a href="{{ route('admin.users.index') }}" 
   class="group flex items-center gap-3 px-4 py-3 
   {{ request()->routeIs('admin.users.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }}
   rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">

    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110"
         fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="1.6">

        <path stroke-linecap="round" stroke-linejoin="round"
              d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
        <circle cx="9" cy="7" r="4"/>

    </svg>

    Customers

</a>


<a href="{{ route('admin.staff.index') }}" 
   class="group flex items-center gap-3 px-4 py-3 
   {{ request()->routeIs('admin.staff.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }}
   rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">

    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale_110"
         fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="1.6">

        <path stroke-linecap="round" stroke-linejoin="round"
              d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-6a4 4 0 11-8 0 4 4 0 018 0z"/>

    </svg>

    Staff

</a>
            </nav>
        </div>

        <!-- Admin Profile Info -->
        <div class="p-4 border-t border-peony/10 bg-peony/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-espresso text-white rounded-full flex items-center justify-center font-bold text-sm">
                    AD
                </div>
                <div>
                    <p class="text-sm font-semibold text-espresso">Admin Account</p>
                    <p class="text-xs text-espresso/40">Role: Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-xl border border-peony/30 bg-white px-3 py-2 text-sm font-semibold text-espresso/70 transition-all duration-200 hover:-translate-y-0.5 hover:bg-peony/10 hover:text-espresso">
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H6a2 2 0 00-2 2v10a2 2 0 002 2h3m4-4l4-4m0 0l-4-4m4 4H9" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>