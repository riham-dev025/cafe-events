@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold text-peony mb-2">
        My Profile
    </h1>

    <p class="text-gray-500 mb-8">
        Welcome back, {{ auth()->user()->name }}!
    </p>

    <div class="grid lg:grid-cols-3 gap-8">
<div class="bg-white rounded-2xl shadow-lg p-8">

    <h2 class="text-2xl font-semibold mb-6">
        Personal Information
    </h2>

    @if(session('success'))
        <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">

        @csrf
        @method('PATCH')

        <div class="space-y-5">

            <div>
                <label class="block text-sm mb-2">
                    Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    class="w-full border rounded-lg px-4 py-3">
            </div>

            <div>
                <label class="block text-sm mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    class="w-full border rounded-lg px-4 py-3">
            </div>

            <div>
                <label class="block text-sm mb-2">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', auth()->user()->phone) }}"
                    class="w-full border rounded-lg px-4 py-3">
            </div>

            <button
                class="bg-peony text-espresso px-6 py-3 rounded-lg hover:opacity-90">

                Save Changes

            </button>

        </div>

    </form>

</div>
        <!-- LEFT COLUMN -->
        <div class="lg:col-span-2">

            <!-- Personal Information Card -->

        </div>
<div class="bg-white rounded-2xl shadow-lg p-8">
<div class="bg-white rounded-2xl shadow-lg p-8">

    <h2 class="text-2xl font-semibold mb-6">
        Security
    </h2>

    <p class="text-gray-500 mb-6">
        Keep your account secure by changing your password regularly.
    </p>

    <a
        href="{{ route('password.request') }}"
        class="inline-block bg-espresso text-white px-5 py-3 rounded-lg">

        Change Password

    </a>

</div>
  
        <!-- RIGHT COLUMN -->
        <div>

            <!-- Security Card -->

        </div>

    </div>

    <!-- BOOKINGS -->
<div class="mt-10">

    <h2 class="text-3xl font-bold text-peony mb-6">
        My Bookings
    </h2>

    @forelse($bookings as $booking)

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

            <div class="flex justify-between items-start">

                <div>

                    <h3 class="text-2xl font-semibold text-espresso">
                        {{ $booking->service->name }}
                    </h3>

                    <p class="text-gray-500 mt-1">
                        {{ $booking->service->description }}
                    </p>

                </div>

                {{-- Status Badge --}}
                @php

                    $badge = match($booking->booking_status){

                        'pending' => 'bg-yellow-100 text-yellow-700',

                        'confirmed' => 'bg-blue-100 text-blue-700',

                        'completed' => 'bg-green-100 text-green-700',

                        'cancelled' => 'bg-red-100 text-red-700',

                        default => 'bg-gray-100 text-gray-700'

                    };

                @endphp

                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $badge }}">
                    {{ ucfirst($booking->booking_status) }}
                </span>

            </div>

            <div class="grid md:grid-cols-2 gap-4 mt-6">

                <div>

                    📅
                    {{ $booking->booking_start->format('F d, Y') }}

                </div>

                <div>

                    🕒
                    {{ $booking->booking_start->format('h:i A') }}

                </div>

                <div>

                    🪑
                    {{ $booking->resource->name }}

                </div>

                <div>

                    👥
                    {{ $booking->seats_reserved }}
                    {{ Str::plural('Guest', $booking->seats_reserved) }}

                </div>

              <div>
    👩
    {{ $booking->staff?->user?->name ?? 'Not Assigned' }}
    @if($booking->staff)
        <span class="text-gray-500">
            ({{ ucfirst($booking->staff->position) }})
        </span>
    @endif
</div>

                <div>

                    💳
                    {{ ucfirst($booking->payment_status) }}

                </div>

            </div>

            <div class="mt-6 flex justify-end">

                <a
                    href="{{ route('bookings.show', $booking) }}"
                    class="bg-peony text-espresso px-5 py-2 rounded-lg hover:opacity-90">

                    View Details

                </a>

            </div>

        </div>

    @empty

        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

            <h3 class="text-xl font-semibold mb-2">
                No Bookings Yet
            </h3>

            <p class="text-gray-500">
                Start by booking one of our experiences!
            </p>

        </div>

    @endforelse

</div>

    <!-- ORDERS -->
     <div class="mt-10">

<h2 class="text-3xl font-bold text-peony mb-6">
    My Orders
</h2>


@forelse($orders as $order)


<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">


<div class="flex justify-between">


<div>

<h3 class="text-xl font-semibold">
Order #{{ $order->id }}
</h3>


<p class="text-gray-500">
{{ $order->created_at->format('F d, Y') }}
</p>


</div>



@php

$status = match($order->order_status){

'pending'=>'bg-yellow-100 text-yellow-700',

'preparing'=>'bg-blue-100 text-blue-700',

'completed'=>'bg-green-100 text-green-700',

'cancelled'=>'bg-red-100 text-red-700',

default=>'bg-gray-100 text-gray-700'

};

@endphp


<span class="px-4 py-2 rounded-full {{ $status }}">

{{ ucfirst($order->order_status) }}

</span>


</div>



<div class="mt-6 space-y-3">


@foreach($order->items as $item)


<div class="flex justify-between">


<span>

{{ $item->product->name }}

× {{ $item->quantity }}

</span>


<span>

${{ number_format($item->unit_price * $item->quantity,2) }}

</span>


</div>


@endforeach


</div>




<div class="border-t mt-6 pt-4 flex justify-between items-center">


<div>

<strong>
Total
</strong>


<p class="text-lg font-bold">

${{ number_format($order->total_amount,2) }}

</p>

</div>



<a href="{{ route('orders.show', $order) }}"
   class="bg-peony text-espresso px-5 py-2 rounded-lg hover:opacity-90">

    View Details

</a>


</div>


</div>


@empty


<div class="bg-white rounded-2xl shadow p-8 text-center">

<p class="text-gray-500">
You have no orders yet.
</p>

</div>


@endforelse


</div>

</div>

@endsection