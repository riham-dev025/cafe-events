@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#faf8f5] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Cozy Header Area -->
        <div class="text-center mb-16">
            <span class="px-4 py-1.5 rounded-full bg-peony/30 text-espresso text-xs font-bold uppercase tracking-widest">
                Handcrafted with Love
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-espresso mt-4 tracking-tight">
                Our Cozy Collection
            </h1>
            <p class="text-stone-500 mt-2 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                Take a moment to browse our fresh bakes, sweet treats, and signature espresso blends curated just for you.
            </p>
            <div class="w-16 h-1 bg-peony mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Session Notifications -->
        @if(session('success'))
            <div class="max-w-3xl mx-auto mb-10 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl shadow-sm text-sm">
                ✨ {{ session('success') }}
            </div>
        @endif

        <!-- Smooth Cozy Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($products as $product)
                <div class="group bg-white rounded-[2rem] border border-stone-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                    
                    <!-- Product Image Container -->
                    <div class="relative pt-[100%] bg-[#f4ece8] overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <!-- Beautiful Warm Placeholder Gradient & Cozy Icon if no image exists -->
                            <div class="absolute inset-0 bg-gradient-to-tr from-[#ede4df] to-peony/20 flex flex-col items-center justify-center p-6 text-center">
                                <span class="text-4xl mb-2 opacity-80">☕</span>
                                <span class="text-[10px] font-bold text-espresso/40 tracking-wider uppercase">Nook & Peony Blend</span>
                            </div>
                        @endif

                        <!-- Cozy Stock Tag -->
                        @if($product->stock <= 0)
                            <span class="absolute top-4 right-4 bg-stone-800/80 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full backdrop-blur-sm">
                                Sold Out
                            </span>
                        @elseif($product->stock <= 3)
                            <span class="absolute top-4 right-4 bg-amber-500/90 text-white text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-full backdrop-blur-sm animate-pulse">
                                Only {{ $product->stock }} Left!
                            </span>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 md:p-8 flex-1 flex flex-col justify-between">
                        <div>
                            <!-- Category Badge -->
                            <span class="text-xs font-black tracking-widest text-peony uppercase block mb-2">
                                {{ $product->category?->name ?? 'Fresh Goods' }}
                            </span>

                            <!-- Name -->
                            <h3 class="text-xl font-bold text-espresso group-hover:text-peony transition-colors duration-200">
                                {{ $product->name }}
                            </h3>

                            <!-- Short Description -->
                            <p class="text-stone-500 text-xs mt-2 leading-relaxed line-clamp-2">
                                {{ $product->description ?? 'No description provided yet, but we guarantee it is delicious!' }}
                            </p>
                        </div>

                        <!-- Price & Add to Cart Footer -->
                        <div class="mt-6 pt-6 border-t border-stone-50 flex items-center justify-between">
                            <div>
                                <span class="text-stone-400 text-[10px] uppercase tracking-wider block">Price</span>
                                <span class="text-2xl font-black text-espresso">
                                    ${{ number_format($product->price, 2) }}
                                </span>
                            </div>

                            @if($product->stock > 0)
                                <form action="{{ route('products.cart', $product->id) }}" class="ajax-cart-form" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center px-5 py-3 bg-peony hover:bg-[#ebafc0] text-espresso text-xs font-black rounded-2xl shadow-sm transition-all duration-200 uppercase tracking-widest active:scale-95">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled 
                                        class="px-5 py-3 bg-stone-100 text-stone-400 text-xs font-black rounded-2xl uppercase tracking-widest cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>

                </div>
            @empty
                <!-- Cozy Empty State -->
                <div class="col-span-full bg-white rounded-[2rem] border border-stone-100 p-16 text-center shadow-sm">
                    <span class="text-5xl block mb-4">🥐</span>
                    <h3 class="text-xl font-bold text-espresso">The pantry is temporarily empty!</h3>
                    <p class="text-stone-500 text-sm mt-1 max-w-sm mx-auto">We are busy baking and brewing more delicious goodies. Check back in a few moments!</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection