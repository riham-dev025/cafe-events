@extends('layouts.app')

@section('content')

<!-- Header -->
<div class="bg-espresso text-center px-8 py-14">
    <p class="text-peony text-sm mb-3">
        Nook & Peony
    </p>

    <h1 class="text-white text-3xl font-medium mb-4">
        Your Cart
    </h1>

    <p class="text-peony/80 text-sm max-w-md mx-auto">
        Your selected drinks, desserts, and little treats.
    </p>
</div>


<div class="px-8 py-12">

    @if(empty($cart))

        <!-- Empty cart -->
        <div class="text-center py-10">

            <h2 class="text-espresso text-lg font-medium mb-2">
                Your cart is empty
            </h2>

            <p class="text-espresso/60 text-sm mb-6">
                Add something sweet from our menu.
            </p>

            <a href="{{ route('products.index') }}"
               class="bg-peony text-espresso text-sm font-medium px-6 py-3 rounded-lg">
                Browse menu
            </a>

        </div>


    @else


        <div class="grid grid-cols-3 gap-8">


            <!-- Cart Items -->
            <div class="col-span-2 space-y-4">


                @foreach($cart as $id => $item)

                    <div class="bg-peony/10 rounded-xl px-6 py-5 flex justify-between items-center">


                        <div>

                            <h3 class="text-espresso text-sm font-medium mb-2">
                                {{ $item['name'] }}
                            </h3>


                            <p class="text-espresso/60 text-xs">
                                Quantity: {{ $item['quantity'] }}
                            </p>


                            <p class="text-espresso/60 text-xs mt-1">
                                Price: ${{ number_format($item['price'], 2) }}
                            </p>

                        </div>



                        <div class="text-right">

                            <p class="text-espresso text-sm font-medium">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>


                        </div>


                    </div>

                @endforeach


            </div>



            <!-- Summary -->
            <div class="bg-espresso rounded-xl px-6 py-6 h-fit">


                <h2 class="text-white text-lg font-medium mb-5">
                    Order Summary
                </h2>


                @php
                    $total = 0;

                    foreach($cart as $item){
                        $total += $item['price'] * $item['quantity'];
                    }
                @endphp



                <div class="flex justify-between text-sm mb-5">

                    <span class="text-peony/80">
                        Total
                    </span>


                    <span class="text-white font-medium">
                        ${{ number_format($total, 2) }}
                    </span>

                </div>



                <a href="#"
                   class="block text-center bg-peony text-espresso text-sm font-medium px-5 py-3 rounded-lg">
                    Proceed to checkout
                </a>


                <a href="{{ route('products.index') }}"
                   class="block text-center text-peony text-sm mt-4 hover:opacity-80">
                    Continue shopping
                </a>


            </div>


        </div>


    @endif


</div>


@endsection