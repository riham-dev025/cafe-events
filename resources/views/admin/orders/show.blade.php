@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-[#FDF8F6]">

    @include('admin.sidebar')

    <!-- MAIN -->

    <main class="flex-1 p-8">


        <!-- HEADER -->

        <div class="flex justify-between items-center mb-8">


            <div class="flex items-center gap-3">

                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-peony/20 text-espresso shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 8h12l-1 12H7L6 8zM9 8V6a3 3 0 116 0v2" />
                    </svg>
                </span>

                <div>

                    <h1 class="text-3xl font-bold text-espresso">
                        Order #{{ $order->id }}
                    </h1>

                    <p class="text-sm text-espresso/50 mt-1">
                        Complete order information and customer details
                    </p>

                </div>

            </div>


            <a href="{{route('admin.orders.index')}}"
            class="inline-flex items-center gap-2 px-5 py-2 rounded-xl bg-white border border-peony/20 text-sm text-espresso hover:bg-peony/10 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back

            </a>


        </div>




        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            <!-- CUSTOMER CARD -->

            <div class="bg-white rounded-2xl shadow-sm border border-peony/10 p-6">


                <h2 class="font-bold text-lg text-espresso mb-5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Customer
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


                <h2 class="font-bold text-lg text-espresso mb-5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l7 4v6c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6z"></path>
                    </svg>
                    Order Status
                </h2>


                <div class="space-y-4">


                    <div>

                        <p class="text-xs text-espresso/40">
                            Current Status
                        </p>
                        <div class="mt-6 space-y-3">

    @if($order->order_status === 'pending')

        <!-- Move to Preparing -->

        <form method="POST" action="{{ route('admin.orders.status',$order->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="Preparing">

            <button
            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl bg-blue-100 text-blue-700 font-semibold hover:bg-blue-200 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M12 8v4l3 2"></path>
                </svg>
                Start Preparing

            </button>

        </form>



        <!-- Cancel Order -->

        <form method="POST" action="{{ route('admin.orders.status',$order->id) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="Cancelled">

            <button
            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl bg-red-100 text-red-700 font-semibold hover:bg-red-200 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                Cancel Order

            </button>

        </form>


    @endif





    @if($order->order_status === 'Preparing')


        <form method="POST" action="{{ route('admin.orders.status',$order->id) }}">
            @csrf
            @method('PATCH')


            <input type="hidden" name="status" value="Completed">


            <button
            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl bg-green-100 text-green-700 font-semibold hover:bg-green-200 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                Mark Completed

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
                class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl bg-green-100 text-green-700 font-semibold hover:bg-green-200 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="4" width="22" height="16" rx="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                Mark Payment Received

            </button>

        </form>

    @else

        <div class="mt-4 inline-flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl bg-green-50 text-green-700 font-semibold text-center">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            Payment Completed

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

                <h2 class="font-bold text-lg text-espresso mb-5 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Timeline
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


            <h2 class="text-xl font-bold text-espresso mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle>
                    <circle cx="20" cy="21" r="1"></circle>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                Order Items
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