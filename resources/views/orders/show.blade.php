@extends('layouts.app')


@section('content')


<div class="max-w-4xl mx-auto px-6 py-10">


<a href="{{ route('profile.edit') }}"
   class="inline-flex items-center gap-1.5 text-espresso hover:opacity-80 text-sm transition">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
    </svg>
    Back to Profile

</a>



<div class="mt-6 bg-white rounded-3xl shadow-lg p-8">


{{-- Header --}}

<div class="flex justify-between items-start border-b pb-6 gap-4">


<div class="flex items-start gap-4">

    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-espresso/10 text-espresso shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
            <line x1="12" y1="22.08" x2="12" y2="12"></line>
        </svg>
    </span>

    <div>

        <h1 class="text-3xl font-bold text-espresso">

        Order #{{ $order->id }}

        </h1>


        <p class="text-gray-500 mt-2">

        {{ $order->created_at->format('F d, Y - h:i A') }}

        </p>

    </div>


</div>



@php

$status = match($order->order_status){

'pending'
=> 'bg-yellow-100 text-yellow-700',

'preparing'
=> 'bg-blue-100 text-blue-700',

'completed'
=> 'bg-green-100 text-green-700',

'cancelled'
=> 'bg-red-100 text-red-700',

default
=> 'bg-gray-100 text-gray-700'

};

@endphp



<span class="shrink-0 px-4 py-2 rounded-full font-semibold text-sm whitespace-nowrap {{ $status }}">

{{ ucfirst($order->order_status) }}

</span>


</div>





{{-- Items --}}

<div class="mt-8">


<h2 class="text-xl font-semibold mb-4 text-espresso flex items-center gap-2">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-espresso shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 7h-3V6a4 4 0 0 0-8 0v1H6a1 1 0 0 0-1 .89l-1 9A2 2 0 0 0 6 19h12a2 2 0 0 0 2-2.11l-1-9A1 1 0 0 0 18 7z"></path>
        <path d="M9 11V6a3 3 0 0 1 6 0v5"></path>
    </svg>
    Items

</h2>



@foreach($order->items as $item)


<div class="flex justify-between items-center bg-[#FDF8F6] rounded-xl p-4 mb-3">


<div>


<p class="font-semibold text-espresso">

{{ $item->product->name }}

</p>


<p class="text-gray-500">

Quantity: {{ $item->quantity }}

</p>


</div>



<p class="font-semibold text-espresso">

${{ number_format(
$item->unit_price * $item->quantity,
2
) }}

</p>


</div>



@endforeach


</div>





{{-- Payment --}}

<div class="mt-8 grid md:grid-cols-2 gap-5">


<div class="bg-[#FDF8F6] rounded-xl p-5">

<p class="text-gray-500 text-sm">

Payment Method

</p>


<p class="font-semibold mt-1 flex items-center gap-2 text-espresso">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-espresso shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="1" y="4" width="22" height="16" rx="2"></rect>
        <line x1="1" y1="10" x2="23" y2="10"></line>
    </svg>
{{ ucfirst($order->payment_method) }}

</p>


</div>




<div class="bg-[#FDF8F6] rounded-xl p-5">


<p class="text-gray-500 text-sm">

Payment Status

</p>


<p class="font-semibold mt-1 flex items-center gap-2 text-espresso">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-espresso shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"></circle>
        <path d="M12 6v2m0 8v2"></path>
        <path d="M15 9.5c0-1.4-1.34-2.5-3-2.5s-3 1.1-3 2.5 1.34 2 3 2 3 .6 3 2-1.34 2.5-3 2.5-3-1.1-3-2.5"></path>
    </svg>
{{ ucfirst($order->payment_status) }}

</p>


</div>


</div>






{{-- Total --}}

<div class="border-t mt-8 pt-6 flex justify-between items-center">


<h2 class="text-xl font-bold text-espresso">

Total

</h2>



<h2 class="text-xl font-bold text-espresso">

${{ number_format($order->total_amount,2) }}

</h2>


</div>



</div>


</div>


@endsection