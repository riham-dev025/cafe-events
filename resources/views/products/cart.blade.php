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

<div class="px-8 py-12 max-w-6xl mx-auto">

    <!-- Global Success or Error Alerts -->
    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 rounded-xl p-4 mb-8 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-600 rounded-xl p-4 mb-8 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    @if(empty($cart))

        <!-- Empty cart State -->
        <div class="text-center py-20 bg-peony/5 rounded-2xl border border-peony/10">
            <h2 class="text-espresso text-lg font-medium mb-2">
                Your cart is empty
            </h2>

            <p class="text-espresso/60 text-sm mb-6">
                Add something sweet from our menu.
            </p>

            <a href="{{ route('products.index') }}"
               class="inline-block bg-peony text-espresso text-sm font-medium px-6 py-3 rounded-lg hover:opacity-90 transition duration-150">
                Browse menu
            </a>
        </div>

    @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Cart Items List (Spans 2 columns on large screens) -->
            <div class="lg:col-span-2 space-y-4">

                @foreach($cart as $id => $item)
                    <div class="bg-peony/10 rounded-xl px-6 py-5 flex justify-between items-center border border-peony/5">

                        <div>
                            <h3 class="text-espresso text-base font-medium mb-1">
                                {{ $item['name'] }}
                            </h3>

                            <div class="flex space-x-4 text-espresso/60 text-xs">
                                <span>Quantity: <strong>{{ $item['quantity'] }}</strong></span>
                                <span>•</span>
                                <span>Price: ${{ number_format($item['price'], 2) }}</span>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-espresso text-base font-semibold">
                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>

            <!-- Summary Card (Spans 1 column) -->
            <div class="bg-espresso rounded-xl px-6 py-6 h-fit text-white">

                <h2 class="text-lg font-medium mb-5 border-b border-white/10 pb-3">
                    Order Summary
                </h2>

                @php
                    $total = 0;
                    foreach($cart as $item){
                        $total += $item['price'] * $item['quantity'];
                    }
                @endphp

                <!-- Total Display -->
                <div class="flex justify-between text-sm mb-6">
                    <span class="text-peony/80">
                        Total Amount
                    </span>
                    <span class="text-xl font-semibold text-peony">
                        ${{ number_format($total, 2) }}
                    </span>
                </div>

                <!-- Simulated Checkout Form -->
                <form action="{{ route('products.checkout') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="payment_method" class="block text-peony/80 text-xs mb-2 font-medium">
                            Payment Method (Simulated)
                        </label>
                        <select name="payment_method" id="payment_method" required
                                class="w-full bg-white/10 text-white text-sm border border-peony/20 rounded-lg px-3 py-2.5 focus:outline-none focus:border-peony cursor-pointer">
                            <option value="Pay at Shop" class="text-espresso">Pay at Shop</option>
                            <option value="Cash on Delivery" class="text-espresso">Cash on Delivery</option>
                            <option value="Manual Payment" class="text-espresso">Manual Payment</option>
                        </select>
                        <p class="text-[10px] text-peony/60 mt-1.5">
                            * No real credit cards or payment gateways are used.
                        </p>
                    </div>

                    <button type="submit"
                            class="w-full text-center bg-peony text-espresso text-sm font-medium px-5 py-3 rounded-lg hover:brightness-105 active:scale-[0.99] transition duration-150">
                        Place Order (${{ number_format($total, 2) }})
                    </button>
                </form>

                <a href="{{ route('products.index') }}"
                   class="block text-center text-peony/80 text-xs mt-4 hover:text-peony transition duration-150">
                    ← Continue shopping
                </a>

            </div>

        </div>

    @endif

</div>

@endsection