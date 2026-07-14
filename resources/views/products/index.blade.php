@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="bg-espresso text-center px-8 py-14">
    <p class="text-peony text-sm mb-3">
        Nook & Peony Café
    </p>

    <h1 class="text-white text-3xl font-medium mb-4">
        Our Menu
    </h1>

    <p class="text-peony/80 text-base max-w-md mx-auto">
        Handcrafted drinks, desserts, and little gifts made for slow moments.
    </p>
</div>


<!-- Products -->
<div class="px-8 py-12">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-espresso text-lg font-medium">
                Available treats
            </h2>

            <p class="text-espresso/60 text-sm">
                Choose your favourites and add them to your cart.
            </p>
        </div>

        <a href="{{route('cart.index')}}" 
           class="text-espresso text-sm hover:opacity-70">
            View cart
        </a>
    </div>


    @if(session('success'))
        <div class="bg-peony/20 text-espresso text-sm px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif



    <div class="grid grid-cols-3 gap-5">

        @foreach ($products as $product)

            <div class="bg-peony/10 rounded-xl px-5 py-5">

                <!-- Product name -->
                <h3 class="text-espresso text-sm font-medium mb-2">
                    {{ $product->name }}
                </h3>


                <!-- Description -->
                @if($product->description)
                    <p class="text-espresso/60 text-xs mb-4">
                        {{ $product->description }}
                    </p>
                @endif


                <!-- Price + Button -->
                <div class="flex items-center justify-between mt-5">

                    <p class="text-espresso text-sm font-medium">
                        ${{ number_format($product->price, 2) }}
                    </p>


                    <form method="POST" 
                          action="{{ route('products.cart', $product->id) }}">

                        @csrf

                        <button type="submit"
                            class="bg-peony text-espresso text-xs font-medium px-4 py-2 rounded-lg hover:opacity-90">

                            Add

                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>


@endsection