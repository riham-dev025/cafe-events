@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#FDF8F6]">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-peony/20 flex flex-col justify-between shrink-0">

        <div>

            <div class="p-6 border-b border-peony/10 flex items-center gap-3">
                <div class="h-10 w-10 bg-peony/20 rounded-xl flex items-center justify-center text-espresso">
                    ☕
                </div>

                <div>
                    <h2 class="font-bold text-espresso">
                        Nook & Peony
                    </h2>
                    <span class="text-xs text-espresso/40">
                        RestroPanel v1.0
                    </span>
                </div>
            </div>


            <nav class="p-4 space-y-1">

                <a href="{{route('admin.dashboard')}}"
                class="block px-4 py-3 rounded-xl text-sm text-espresso/60 hover:bg-peony/10">
                    📊 Dashboard
                </a>


                <a href="{{route('admin.orders.index')}}"
                class="block px-4 py-3 rounded-xl text-sm bg-peony text-espresso font-medium">
                    🛍️ Orders
                </a>


                <a href="{{route('admin.products.index')}}"
                class="block px-4 py-3 rounded-xl text-sm text-espresso/60 hover:bg-peony/10">
                    🍰 Products
                </a>


                <a href="{{route('admin.events.index')}}"
                class="block px-4 py-3 rounded-xl text-sm text-espresso/60 hover:bg-peony/10">
                    📅 Events
                </a>


                <a href="{{route('admin.bookings.index')}}"
                class="block px-4 py-3 rounded-xl text-sm text-espresso/60 hover:bg-peony/10">
                    🌸 Bookings
                </a>

            </nav>

        </div>


        <div class="p-4 border-t border-peony/10 bg-peony/5">

            <p class="text-sm font-semibold text-espresso">
                Admin Account
            </p>

            <p class="text-xs text-espresso/40 mb-3">
                Administrator
            </p>


            <form method="POST" action="{{route('logout')}}">
                @csrf

                <button
                class="w-full rounded-xl bg-white border border-peony/30 py-2 text-sm text-espresso">
                    🚪 Logout
                </button>

            </form>

        </div>


    </aside>




    <!-- MAIN -->

    <main class="flex-1 p-8">


        <!-- HEADER -->

        <div class="flex justify-between items-center mb-8">


            <div>

                <h1 class="text-3xl font-bold text-espresso">
                    Order #{{ $order->id }}
                </h1>

                <p class="text-sm text-espresso/50 mt-1">
                    Complete order information and customer details
                </p>

            </div>


            <a href="{{route('admin.orders.index')}}"
            class="px-5 py-2 rounded-xl bg-white border border-peony/20 text-sm text-espresso hover:bg-peony/10">

                ← Back

            </a>


        </div>




        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            <!-- CUSTOMER CARD -->

            <div class="bg-white rounded-2xl shadow-sm border border-peony/10 p-6">


                <h2 class="font-bold text-lg text-espresso mb-5">
                    👤 Customer
                </h2>


                <div class="space-y-3 text-sm">


                    <div>
                        <p class="text-espresso/40">
                            Name
                        </p>

                        <p class="font-semibold text-espresso">
                            {{ $order->user->name ?? 'Guest' }}
                        </p>

                    </div>



                    <div>
                        <p class="text-espresso/40">
                            Email
                        </p>

                        <p class="text-espresso">
                            {{ $order->user->email ?? '-' }}
                        </p>

                    </div>


                    <div>
                        <p class="text-espresso/40">
                            Phone
                        </p>

                        <p class="text-espresso">
                            {{ $order->user->phone ?? '-' }}
                        </p>

                    </div>



                </div>


            </div>






            <!-- ORDER STATUS -->

            <div class="bg-white rounded-2xl shadow-sm border border-peony/10 p-6">


                <h2 class="font-bold text-lg text-espresso mb-5">
                    📌 Order Status
                </h2>


                <div class="space-y-4">


                    <div>

                        <p class="text-xs text-espresso/40">
                            Current Status
                        </p>
                        <div class="mt-6 space-y-3">
<h1>
DEBUG STATUS: {{$order->order_status}}
</h1>

    @if($order->order_status === 'pending')

        <!-- Move to Preparing -->

        <form method="POST" action="{{ route('admin.orders.status',$order->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="Preparing">

            <button
            class="w-full py-3 rounded-xl bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 transition">

                👨‍🍳 Start Preparing

            </button>

        </form>



        <!-- Cancel Order -->

        <form method="POST" action="{{ route('admin.orders.status',$order->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="Cancelled">

            <button
            class="w-full py-3 rounded-xl bg-red-100 text-red-700 font-semibold hover:bg-red-200 transition">

                ❌ Cancel Order

            </button>

        </form>


    @endif





    @if($order->order_status === 'Preparing')


        <form method="POST" action="{{ route('admin.orders.status',$order->id) }}">
            @csrf
            @method('PATCH')


            <input type="hidden" name="status" value="Completed">


            <button
            class="w-full py-3 rounded-xl bg-green-100 text-green-700 font-semibold hover:bg-green-200 transition">

                ✅ Mark Completed

            </button>


        </form>


    @endif



</div>


                        <span class="inline-block mt-2 px-4 py-2 rounded-full text-sm font-semibold

                        @if($order->order_status=='Pending')
                        bg-yellow-100 text-yellow-700

                        @elseif($order->order_status=='Preparing')
                        bg-blue-100 text-blue-700

                        @elseif($order->order_status=='Completed')
                        bg-green-100 text-green-700

                        @else
                        bg-red-100 text-red-700

                        @endif">

                        {{ $order->order_status }}

                        </span>


                    </div>



                   <div>

    <p class="text-xs text-espresso/40">
        Payment
    </p>


    <p class="font-semibold mt-1 text-espresso">
        {{ ucfirst($order->payment_status) }}
    </p>


    @if($order->payment_status !== 'Paid')

        <form method="POST"
              action="{{ route('admin.orders.payment', $order) }}"
              class="mt-4">

            @csrf
            @method('PATCH')

            <button
                class="w-full py-3 rounded-xl bg-green-100 text-green-700 font-semibold hover:bg-green-200 transition">

                💵 Mark Payment Received

            </button>

        </form>

    @else

        <div class="mt-4 px-4 py-3 rounded-xl bg-green-50 text-green-700 font-semibold text-center">

            ✅ Payment Completed

        </div>

    @endif


</div>



                    <div>

                        <p class="text-xs text-espresso/40">
                            Payment Method
                        </p>


                        <p class="text-espresso">
                            {{ $order->payment_method }}
                        </p>


                    </div>



                </div>


            </div>







            <!-- DATE -->

            <div class="bg-white rounded-2xl shadow-sm border border-peony/10 p-6">

                <h2 class="font-bold text-lg text-espresso mb-5">
                    🕒 Timeline
                </h2>


                <p class="text-sm text-espresso/50">
                    Ordered At
                </p>

                <p class="font-semibold text-espresso mt-1">
                    {{ $order->created_at->format('M d, Y h:i A') }}
                </p>


            </div>


        </div>






        <!-- ITEMS -->

        <div class="mt-8 bg-white rounded-2xl border border-peony/10 shadow-sm p-8">


            <h2 class="text-xl font-bold text-espresso mb-6">
                🛒 Order Items
            </h2>



            <div class="space-y-4">


                @foreach($order->items as $item)


                <div class="flex justify-between items-center bg-[#FDF8F6] rounded-xl p-4">


                    <div>

                        <p class="font-semibold text-espresso">
                            {{ $item->product->name }}
                        </p>


                        <p class="text-sm text-espresso/50">
                            Quantity: {{ $item->quantity }}
                        </p>


                    </div>



                    <p class="font-bold text-espresso">

                        ${{ number_format($item->unit_price * $item->quantity,2) }}

                    </p>


                </div>


                @endforeach


            </div>





            <div class="border-t border-peony/20 mt-6 pt-5 flex justify-between">


                <span class="text-lg font-bold text-espresso">
                    Total
                </span>


                <span class="text-xl font-extrabold text-espresso">

                    ${{number_format($order->total_amount,2)}}

                </span>


            </div>



        </div>



    </main>


</div>


@endsection