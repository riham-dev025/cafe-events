@extends('layouts.app')


@section('content')


<div class="max-w-4xl mx-auto px-6 py-10">


<a href="{{ route('profile.edit') }}"
   class="text-peony hover:opacity-80 text-sm">

    ← Back to Profile

</a>



<div class="mt-6 bg-white rounded-3xl shadow-lg p-8">


{{-- Header --}}

<div class="flex justify-between items-start border-b pb-6">


<div>

<h1 class="text-3xl font-bold text-espresso">

Order #{{ $order->id }}

</h1>


<p class="text-gray-500 mt-2">

{{ $order->created_at->format('F d, Y - h:i A') }}

</p>


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



<span class="px-4 py-2 rounded-full {{ $status }}">

{{ ucfirst($order->order_status) }}

</span>


</div>





{{-- Items --}}

<div class="mt-8">


<h2 class="text-xl font-semibold mb-4">

Items

</h2>



@foreach($order->items as $item)


<div class="flex justify-between items-center bg-[#FDF8F6] rounded-xl p-4 mb-3">


<div>


<p class="font-semibold">

{{ $item->product->name }}

</p>


<p class="text-gray-500">

Quantity: {{ $item->quantity }}

</p>


</div>



<p class="font-semibold">

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


<p class="font-semibold mt-1">

💳
{{ ucfirst($order->payment_method) }}

</p>


</div>




<div class="bg-[#FDF8F6] rounded-xl p-5">


<p class="text-gray-500 text-sm">

Payment Status

</p>


<p class="font-semibold mt-1">

💰
{{ ucfirst($order->payment_status) }}

</p>


</div>


</div>






{{-- Total --}}

<div class="border-t mt-8 pt-6 flex justify-between">


<h2 class="text-xl font-bold">

Total

</h2>



<h2 class="text-xl font-bold">

${{ number_format($order->total_amount,2) }}

</h2>


</div>



</div>


</div>


@endsection