@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#faf8f5] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">

        <!-- Cozy Header Area -->
        <div class="text-center mb-16">
            <span class="px-4 py-1.5 rounded-full bg-peony/30 text-espresso text-xs font-bold uppercase tracking-widest">
                Nook & Peony
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-espresso mt-4 tracking-tight">
                Your Cart
            </h1>
            <p class="text-stone-500 mt-2 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                Your selected drinks, desserts, and little treats.
            </p>
            <div class="w-16 h-1 bg-peony mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Global Success or Error Alerts -->
        @if(session('success'))
            <div class="max-w-3xl mx-auto mb-10 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl shadow-sm text-sm">
                ✨ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-3xl mx-auto mb-10 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-2xl shadow-sm text-sm">
                🌸 {{ $errors->first() }}
            </div>
        @endif

        <!-- Empty Cart State Cover -->
        <div id="empty-cart-view" class="{{ empty($cart) ? '' : 'hidden' }} bg-white rounded-[2rem] border border-stone-100 p-16 text-center shadow-sm max-w-xl mx-auto">
            <span class="text-5xl block mb-4">🛒</span>
            <h2 class="text-xl font-bold text-espresso">Your cart is empty</h2>
            <p class="text-stone-500 text-xs mt-1 mb-8">Add something sweet or freshly brewed from our menu.</p>
            
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center justify-center px-6 py-3.5 bg-peony hover:bg-[#ebafc0] text-espresso text-xs font-black rounded-2xl shadow-sm transition-all duration-200 uppercase tracking-widest active:scale-95">
                Browse Menu
            </a>
        </div>

        @if(!empty($cart))
            <!-- Active Cart Layout -->
            <div id="active-cart-view" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                <!-- Cart Items List -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $id => $item)
                        <!-- Cart Item Card (Wrapped with a unique ID for dynamic removal) -->
                        <div id="cart-item-{{ $id }}" class="group bg-white rounded-[2rem] p-6 md:p-8 flex justify-between items-center border border-stone-100 shadow-sm hover:shadow-md transition-all duration-300">
                            <div>
                                <span class="text-[10px] font-black tracking-widest text-peony uppercase block mb-1">
                                    Fresh Pick
                                </span>
                                <h3 class="text-lg font-bold text-espresso group-hover:text-peony transition-colors duration-200">
                                    {{ $item['name'] }}
                                </h3>

                                <div class="flex items-center space-x-3 text-stone-400 text-xs mt-2">
                                    <span>Qty: <strong class="text-stone-600 font-bold">{{ $item['quantity'] }}</strong></span>
                                    <span class="opacity-50">•</span>
                                    <span>Price: ${{ number_format($item['price'], 2) }}</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-6 text-right">
                                <div>
                                    <p class="text-xl font-black text-espresso">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </p>
                                </div>
                                
                                <!-- AJAX Remove Button -->
                                <button type="button" onclick="removeCartItem('{{ $id }}')" 
                                        class="text-stone-300 hover:text-rose-500 p-2 rounded-full hover:bg-rose-50/50 transition-all duration-200"
                                        title="Remove item">
                                    <span class="text-lg font-bold">✕</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary Card -->
                <div class="bg-espresso rounded-[2rem] p-8 md:p-10 text-white shadow-xl flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-black mb-6 border-b border-white/10 pb-4 tracking-tight">
                            Order Summary
                        </h2>

                        @php
                            $total = 0;
                            foreach($cart as $item){
                                $total += $item['price'] * $item['quantity'];
                            }
                        @endphp

                        <!-- Total Display (Added ID to subtotal text to update on delete) -->
                        <div class="flex justify-between items-center mb-8 bg-white/5 p-4 rounded-2xl">
                            <span class="text-peony text-xs font-bold uppercase tracking-wider">
                                Total Amount
                            </span>
                            <span id="cart-subtotal" class="text-2xl font-black text-peony">
                                ${{ number_format($total, 2) }}
                            </span>
                        </div>

                        <!-- Simulated Checkout Form -->
                        <form action="{{ route('products.checkout') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div>
                                <label for="payment_method" class="block text-peony text-xs mb-2 font-bold uppercase tracking-wider">
                                    Payment Method (Simulated)
                                </label>
                                <select name="payment_method" id="payment_method" required
                                        class="w-full bg-white/10 text-white text-sm border border-peony/20 rounded-2xl px-4 py-3.5 focus:outline-none focus:border-peony focus:ring-1 focus:ring-peony cursor-pointer transition-colors duration-200">
                                    <option value="Pay at Shop" class="text-espresso">Pay at Shop</option>
                                    <option value="Cash on Delivery" class="text-espresso">Cash on Delivery</option>
                                    <option value="Manual Payment" class="text-espresso">Manual Payment</option>
                                </select>
                                <p class="text-[10px] text-peony/50 mt-2 italic">
                                    * No real payment gateways or credit cards are required.
                                </p>
                            </div>

                            <button type="submit" id="checkout-btn"
                                    class="w-full text-center bg-peony hover:bg-[#ebafc0] text-espresso text-xs font-black px-5 py-4 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-200 uppercase tracking-widest active:scale-95">
                                Place Order (<span id="btn-subtotal">${{ number_format($total, 2) }}</span>)
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('products.index') }}"
                       class="block text-center text-peony/80 text-xs font-bold uppercase tracking-widest mt-8 hover:text-white transition duration-200">
                        ← Continue Shopping
                    </a>
                </div>

            </div>
        @endif

    </div>
</div>

<!-- AJAX Dynamic Removal Script -->
<script>
function removeCartItem(itemId) {
    const itemCard = document.getElementById(`cart-item-${itemId}`);
    if (!itemCard) return;

    // Apply immediate feedback
    itemCard.style.opacity = '0.4';
    itemCard.style.pointerEvents = 'none';

    // Build the request endpoint
    const url = `{{ url('/cart') }}/${itemId}`;
    
    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Request failed.');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Elegant exit animation
            itemCard.style.transform = 'scale(0.95)';
            itemCard.style.opacity = '0';
            
            setTimeout(() => {
                itemCard.remove();
                
                if (data.cart_empty) {
                    // Switch views instantly if the cart is empty
                    const activeView = document.getElementById('active-cart-view');
                    const emptyView = document.getElementById('empty-cart-view');
                    if (activeView) activeView.remove();
                    if (emptyView) emptyView.classList.remove('hidden');
                } else {
                    // Update subtotal text in both the panel and the button
                    const subtotalEl = document.getElementById('cart-subtotal');
                    const btnSubtotalEl = document.getElementById('btn-subtotal');
                    
                    if (subtotalEl) subtotalEl.innerText = `$${data.subtotal}`;
                    if (btnSubtotalEl) btnSubtotalEl.innerText = `$${data.subtotal}`;
                }
            }, 250);
        }
    })
    .catch(error => {
        console.error('AJAX Error removing item:', error);
        // Reset card styling if something broke
        itemCard.style.opacity = '1';
        itemCard.style.pointerEvents = 'auto';
        alert('Could not remove item. Please try again.');
    });
}
</script>
@endsection