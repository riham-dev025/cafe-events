<nav class="flex items-center justify-between px-6 py-4 bg-espresso">

    <a href="{{ route('dashboard') }}" 
       class="text-peony text-lg font-medium">
        Nook & Peony
    </a>

    <div class="flex items-center gap-6">

        {{-- Home Link --}}
        <a href="{{ url('/') }}"
           class="text-peony text-sm hover:opacity-80">
            Home
        </a>

        <a href="{{ route('products.index') }}"
           class="text-peony text-sm hover:opacity-80">
            Menu
        </a>

        @auth

            <a href="{{ route('bookings.index') }}"
               class="text-peony text-sm hover:opacity-80">
                Bookings
            </a>

            <a href="{{ route('cart.index') }}"
               class="text-peony text-sm hover:opacity-80">
                Cart
            </a>

           {{-- Admin Dashboard --}}
@if(auth()->user()->role && strtolower(auth()->user()->role->name) === 'admin')

    <a href="{{ route('admin.dashboard') }}"
       class="text-peony text-sm hover:opacity-80">
        Admin Dashboard
    </a>

{{-- Staff Dashboard --}}
@elseif(auth()->user()->role && strtolower(auth()->user()->role->name) === 'staff')

    <a href="{{ route('staff.dashboard') }}"
       class="text-peony text-sm hover:opacity-80">
        Staff Dashboard
    </a>

@endif
<a href="{{ route('profile.edit') }}"
   class="text-peony text-sm hover:opacity-80">
    Profile
</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="bg-peony text-espresso text-sm font-medium px-4 py-2 rounded-lg hover:opacity-90">
                    Log out
                </button>
            </form>

        @else

            <a href="{{ route('login') }}"
               class="text-peony text-sm hover:opacity-80">
                Sign in
            </a>

            <a href="{{ route('register') }}"
               class="bg-peony text-espresso text-sm font-medium px-4 py-2 rounded-lg hover:opacity-90">
                Sign up
            </a>

        @endauth

    </div>

</nav>