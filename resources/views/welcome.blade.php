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
            <img src="{{ asset('imgs/pantry.jpeg') }}"
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

{{-- ================= ABOUT US BANNER ================= --}}
<div class="bg-espresso relative overflow-hidden py-20 lg:py-28 w-full border-y border-peony/20">

    {{-- Top Left Icon & Text --}}
    <div class="absolute top-6 left-6 lg:top-10 lg:left-12 flex items-center gap-2 text-peony opacity-80">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3M18.364 5.636l-12.728 12.728M5.636 5.636l12.728 12.728"></path></svg>
        <span class="text-xs tracking-[0.2em] uppercase">About Page</span>
    </div>

    {{-- Main Content Wrapper --}}
    <div class="relative w-full max-w-[1400px] mx-auto flex flex-col items-center justify-center pt-10 pb-8">
        
        {{-- Giant Text (Scaled Y to mimic condensed font) --}}
        <h2 class="font-serif text-peony text-[28vw] lg:text-[18rem] leading-[0.75] tracking-tighter text-center select-none transform scale-y-[1.3] z-0 m-0 w-full overflow-hidden whitespace-nowrap">
            ABOUT US
        </h2>

        {{-- Center Image Overlap --}}
        <img src="{{ asset('imgs/about-coffee-glass.png') }}" alt="Signature coffee"
             class="absolute top-[45%] left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-56 sm:w-72 lg:w-[26rem] drop-shadow-[0_25px_35px_rgba(0,0,0,0.4)] z-10">
    </div>

    {{-- Bottom Text Columns --}}
    <div class="relative z-20 w-full max-w-5xl mx-auto grid grid-cols-2 gap-4 lg:gap-20 px-4 lg:px-12 mt-12 lg:mt-16">
        <div class="flex justify-end">
            <p class="text-peony/90 text-[10px] lg:text-sm leading-relaxed max-w-[280px] text-center">
                Nestled in the heart of the neighborhood, our café is more than just a stop &mdash;
                it&rsquo;s a moment of calm in your day. Every cup of coffee and fresh pastry
                reflects care and craftsmanship.
            </p>
        </div>
        <div class="flex justify-start">
            <p class="text-peony/90 text-[10px] lg:text-sm leading-relaxed max-w-[280px] text-center">
                Soft light, warm textures, and genuine hospitality create a sense of harmony.
                It&rsquo;s not just coffee &mdash; it&rsquo;s a feeling of comfort in every visit.
            </p>
        </div>
    </div>

    {{-- Bottom Geometric Pattern --}}
    <div class="absolute bottom-0 left-0 w-full h-8 lg:h-12 flex justify-center overflow-hidden opacity-10 pointer-events-none">
        <div class="flex space-x-[-15px] lg:space-x-[-20px] w-full flex-nowrap min-w-max">
            @for ($i = 0; $i < 60; $i++)
                <div class="w-12 h-12 lg:w-16 lg:h-16 rounded-full border-[3px] border-peony translate-y-1/2 flex-shrink-0"></div>
            @endfor
        </div>
    </div>
</div>

{{-- ================= ABOUT ================= --}}
<div class="bg-espresso px-6 lg:px-16 py-16">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 items-center">

        <img src="{{ asset('imgs/aboutus.jpeg') }}" alt="Bakery interior"
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