<x-site-layout>
    <nav class="flex items-center justify-between px-6 py-4 bg-espresso">
        <span class="text-peony text-lg font-medium">Nook &amp; Peony</span>
        <div class="flex items-center gap-6">
            <a href="{{ route('products.index') }}" class="text-peony text-sm">Menu</a>
            <a href="{{ route('bookings.index') }}" class="text-peony text-sm font-semibold hover:opacity-80">Bookings</a>
            @auth
                <a href="#" class="text-peony text-sm hover:opacity-80">
                My bookings
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

    <div class="bg-espresso text-center px-8 py-16">
        <p class="text-peony text-sm mb-3">Coffee, desserts, and moments worth booking</p>
        <h1 class="text-white text-3xl font-medium max-w-lg mx-auto mb-4">
            A slow morning or a night to remember
        </h1>
        <p class="text-peony/80 text-base max-w-md mx-auto mb-7">
            Order from our menu or reserve one of our signature experiences.
        </p>
        <div class="flex gap-3 justify-center">
            <a href="#" class="bg-peony text-espresso text-sm font-medium px-6 py-3 rounded-lg">
                Order online
            </a>
            <a href="#" class="border border-peony text-peony text-sm font-medium px-6 py-3 rounded-lg">
                Book an experience
            </a>
        </div>
    </div>

    <div class="px-8 py-12">
        <h2 class="text-espresso text-lg font-medium mb-1">From the menu</h2>
        <p class="text-espresso/60 text-sm mb-5">A few favourites to start with.</p>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($featuredProducts as $product)
                <div class="bg-peony/10 rounded-xl px-5 py-4">
                    <p class="text-espresso text-sm font-medium mb-1">{{ $product->name }}</p>
                    <p class="text-espresso/60 text-xs">${{ number_format($product->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="px-8 pb-12">
        <h2 class="text-espresso text-lg font-medium mb-1">Book an experience</h2>
        <p class="text-espresso/60 text-sm mb-5">Limited seats, so reserve ahead.</p>
        <div class="grid grid-cols-3 gap-4">
            @foreach ($featuredServices as $service)
                <div class="bg-espresso rounded-xl px-5 py-4">
                    <p class="text-white text-sm font-medium mb-1">{{ $service->name }}</p>
                    <p class="text-peony text-xs">{{ $service->capacity }} seats</p>
                </div>
            @endforeach
        </div>
    </div>
</x-site-layout>