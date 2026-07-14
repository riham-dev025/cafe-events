@extends('layouts.app')

@section('content')

{{-- ================= HERO ================= --}}
<div class="bg-espresso relative overflow-hidden px-6 lg:px-16 py-16 lg:py-24">

    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

        {{-- Left: copy --}}
        <div class="text-center lg:text-left">
            <p class="text-peony text-sm tracking-wide mb-3">
                Coffee, desserts, and moments worth booking
            </p>

            <h1 class="text-white text-4xl lg:text-5xl font-medium leading-tight max-w-lg mx-auto lg:mx-0 mb-4">
                A slow morning or a night to remember
            </h1>

            <p class="text-peony/80 text-base max-w-md mx-auto lg:mx-0 mb-8">
                Order from our menu or reserve one of our signature experiences.
            </p>

            <div class="flex gap-3 justify-center lg:justify-start">
                <a href="{{ route('products.index') }}"
                   class="bg-peony text-espresso text-sm font-medium px-6 py-3 rounded-lg hover:bg-peony/90 transition">
                    Order online
                </a>

                <a href="{{ route('bookings.create') }}"
                   class="border border-peony text-peony text-sm font-medium px-6 py-3 rounded-lg hover:bg-peony/10 transition">
                    Book an experience
                </a>
            </div>
        </div>

        {{-- Right: image collage --}}
        <div class="relative">
            <img src="{{ asset('images/hero-spread.jpg') }}"
                 alt="Coffee and pastries spread"
                 class="rounded-2xl w-full h-[380px] lg:h-[440px] object-cover shadow-2xl">

            {{-- dotted accent --}}
            <svg class="hidden lg:block absolute -bottom-6 -right-6 w-28 h-28 text-peony/60" viewBox="0 0 100 100" fill="none">
                @for ($row = 0; $row < 6; $row++)
                    @for ($col = 0; $col < 6; $col++)
                        <circle cx="{{ 8 + $col * 17 }}" cy="{{ 8 + $row * 17 }}" r="2.5" fill="currentColor" />
                    @endfor
                @endfor
            </svg>
        </div>

    </div>
</div>

{{-- ================= FEATURES ================= --}}
<div class="bg-white px-6 lg:px-16 py-14">
    <div class="max-w-7xl mx-auto grid sm:grid-cols-2 lg:grid-cols-4 gap-10">

        <div class="text-center lg:text-left">
            <svg class="w-8 h-8 text-espresso mx-auto lg:mx-0 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8h13a3 3 0 013 3 3 3 0 01-3 3h-1M16 8v9a2 2 0 01-2 2H6a2 2 0 01-2-2V8h12zM6 3h1m3 0h1m3 0h1" />
            </svg>
            <h3 class="font-medium text-espresso mb-1">Specialty Coffee</h3>
            <p class="text-sm text-gray-500">Partner roasters &middot; 100% Arabica &middot; precise extraction.</p>
        </div>

        <div class="text-center lg:text-left">
            <svg class="w-8 h-8 text-espresso mx-auto lg:mx-0 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 13c3-6 13-6 16 0-2 1-4 1.5-8 1.5S6 14 4 13z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 13.5V17m8-3.5V17" />
            </svg>
            <h3 class="font-medium text-espresso mb-1">Morning Bakery</h3>
            <p class="text-sm text-gray-500">Croissants, danishes, tarts &amp; focaccia baked in-house.</p>
        </div>

        <div class="text-center lg:text-left">
            <svg class="w-8 h-8 text-espresso mx-auto lg:mx-0 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <rect x="4" y="4" width="16" height="16" rx="3" stroke-linecap="round" stroke-linejoin="round" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h8M8 16h5" />
            </svg>
            <h3 class="font-medium text-espresso mb-1">All-day Breakfast</h3>
            <p class="text-sm text-gray-500">Stretch your morning &mdash; classics served until closing.</p>
        </div>

        <div class="text-center lg:text-left">
            <svg class="w-8 h-8 text-espresso mx-auto lg:mx-0 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-6.2-7-11a7 7 0 1114 0c0 4.8-7 11-7 11z" />
                <circle cx="12" cy="10" r="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <h3 class="font-medium text-espresso mb-1">Fast Pickup</h3>
            <p class="text-sm text-gray-500">Order ahead; be on your way in 15 minutes.</p>
        </div>

    </div>
</div>

{{-- ================= MENU HIGHLIGHTS ================= --}}
<div class="bg-white px-6 lg:px-16 pb-16">
    <div class="max-w-7xl mx-auto">

        <div class="flex items-end justify-between mb-8">
            <h2 class="text-3xl font-medium text-espresso">Menu Highlights</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-espresso/70 hover:text-espresso underline">
                Full menu available in-store and online
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <a href="{{ route('products.index') }}" class="group relative rounded-2xl overflow-hidden h-72">
                <img src="{{ asset('images/menu-espresso.jpg') }}" alt="Espresso creations"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-espresso/80 via-espresso/10 to-transparent"></div>
                <span class="absolute bottom-4 left-4 text-white text-xl font-medium">Espresso Creations</span>
            </a>

            <a href="{{ route('products.index') }}" class="group relative rounded-2xl overflow-hidden h-72">
                <img src="{{ asset('images/menu-cupcakes.jpg') }}" alt="Signature cupcakes"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-espresso/80 via-espresso/10 to-transparent"></div>
                <span class="absolute bottom-4 left-4 text-white text-xl font-medium">Signature Cupcakes</span>
            </a>

            <a href="{{ route('products.index') }}" class="group relative rounded-2xl overflow-hidden h-72">
                <img src="{{ asset('images/menu-brunch.jpg') }}" alt="Brunch toasts"
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                <div class="absolute inset-0 bg-gradient-to-t from-espresso/80 via-espresso/10 to-transparent"></div>
                <span class="absolute bottom-4 left-4 text-white text-xl font-medium">Brunch Toasts</span>
            </a>

        </div>
    </div>
</div>

{{-- ================= ABOUT US BANNER ================= --}}
<div class="bg-espresso relative overflow-hidden rounded-3xl mx-6 lg:mx-16 mb-16 px-6 py-16 lg:py-20">

    <p class="text-center text-peony/60 text-xs tracking-[0.2em] uppercase mb-4">&#10022; About Page</p>

    <div class="relative flex justify-center items-center py-4">
        <h2 class="font-serif text-transparent text-[17vw] lg:text-[7.5rem] leading-none tracking-tight text-center select-none"
            style="-webkit-text-stroke: 1.5px #f4c9d6; text-stroke: 1.5px #f4c9d6;">
            ABOUT US
        </h2>

        <img src="{{ asset('images/about-coffee-glass.png') }}" alt="Signature coffee"
             class="absolute w-32 sm:w-44 lg:w-60 drop-shadow-2xl">
    </div>

    <div class="grid lg:grid-cols-2 gap-6 max-w-4xl mx-auto mt-6 text-center lg:text-left">
        <p class="text-peony/70 text-sm leading-relaxed">
            Nestled in the heart of the neighborhood, our café is more than just a stop &mdash;
            it&rsquo;s a moment of calm in your day. Every cup of coffee and fresh pastry
            reflects care and craftsmanship.
        </p>
        <p class="text-peony/70 text-sm leading-relaxed lg:text-right">
            Soft light, warm textures, and genuine hospitality create a sense of harmony.
            It&rsquo;s not just coffee &mdash; it&rsquo;s a feeling of comfort in every visit.
        </p>
    </div>

    {{-- dotted hex accent row --}}
    <div class="flex justify-center gap-2 mt-10 opacity-40">
        @for ($i = 0; $i < 14; $i++)
            <span class="w-2 h-2 rounded-full bg-peony"></span>
        @endfor
    </div>
</div>

{{-- ================= ABOUT ================= --}}
<div class="bg-espresso px-6 lg:px-16 py-16">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

        <img src="{{ asset('images/about-interior.jpg') }}" alt="Bakery interior"
             class="rounded-2xl w-full h-[420px] object-cover shadow-2xl">

        <div>
            <h2 class="text-white text-3xl lg:text-4xl font-medium mb-4">About Our Bakery &amp; Café</h2>

            <p class="text-peony/80 text-base mb-6">
                We are a local bakery-café serving our neighborhood since 2018. Every morning we bake in-house
                and pull carefully dialed shots of specialty coffee. We lean on local, seasonal ingredients and
                keep quality consistent.
            </p>

            <ul class="text-peony/90 text-sm space-y-2 mb-8">
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-peony"></span> In-house bakery
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-peony"></span> Partner roasters &amp; single-origin beans
                </li>
                <li class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-peony"></span> Warm service and a calm atmosphere
                </li>
            </ul>

            <a href="{{ route('products.index') }}"
               class="inline-block bg-peony text-espresso text-sm font-medium px-6 py-3 rounded-lg hover:bg-peony/90 transition">
                Order online
            </a>
        </div>

    </div>
</div>

@endsection