@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="flex items-center gap-4 mb-8">
        <div class="w-14 h-14 rounded-full bg-peony/20 text-peony flex items-center justify-center text-xl font-bold shrink-0">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
        <div>
            <h1 class="text-4xl font-bold text-peony">
                My Profile
            </h1>
            <p class="text-gray-500 mt-1">
                Welcome back, {{ auth()->user()->name }}!
            </p>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-2">

            <!-- Personal Information Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-peony/10 text-peony">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </span>
                    <h2 class="text-2xl font-semibold">
                        Personal Information
                    </h2>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">

                    @csrf
                    @method('PATCH')

                    <div class="space-y-5">

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Name
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    class="w-full border rounded-lg pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-peony/40 focus:border-peony transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Email
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16v16H4z" stroke="none"></path>
                                        <path d="M22 6l-10 7L2 6"></path>
                                        <path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6z"></path>
                                    </svg>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', auth()->user()->email) }}"
                                    class="w-full border rounded-lg pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-peony/40 focus:border-peony transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">
                                Phone
                            </label>

                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone', auth()->user()->phone) }}"
                                    class="w-full border rounded-lg pl-11 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-peony/40 focus:border-peony transition">
                            </div>
                        </div>

                        <button
                            class="bg-peony text-espresso px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition">

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div>

            <!-- Security Card -->
            <div class="bg-white rounded-2xl shadow-lg p-8">

                <div class="flex items-center gap-3 mb-6">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-espresso/10 text-espresso">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <h2 class="text-2xl font-semibold">
                        Security
                    </h2>
                </div>

                <p class="text-gray-500 mb-6">
                    Keep your account secure by changing your password regularly.
                </p>

                <a
                    href="{{ route('password.request') }}"
                    class="inline-flex items-center gap-2 bg-espresso text-white px-5 py-3 rounded-lg hover:opacity-90 transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    Change Password

                </a>

            </div>

        </div>

    </div>

    <!-- BOOKINGS -->
    <div class="mt-10">

        <div class="flex items-center gap-3 mb-6">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-peony/10 text-peony">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </span>
            <h2 class="text-3xl font-bold text-peony">
                My Bookings
            </h2>
        </div>

        @forelse($bookings as $booking)

            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

                <div class="flex justify-between items-start gap-4">

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

                    <span class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ $badge }}">
                        {{ ucfirst($booking->booking_status) }}
                    </span>

                </div>

                <div class="grid md:grid-cols-2 gap-4 mt-6 text-gray-700">

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        {{ $booking->booking_start->format('F d, Y') }}
                    </div>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        {{ $booking->booking_start->format('h:i A') }}
                    </div>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 17v-6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6"></path>
                            <path d="M2 17h20"></path>
                            <path d="M6 17v3"></path>
                            <path d="M18 17v3"></path>
                            <path d="M8 9V7a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        {{ $booking->resource->name }}
                    </div>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        {{ $booking->seats_reserved }}
                        {{ Str::plural('Guest', $booking->seats_reserved) }}
                    </div>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        {{ $booking->staff?->user?->name ?? 'Not Assigned' }}
                        @if($booking->staff)
                            <span class="text-gray-500">
                                ({{ ucfirst($booking->staff->position) }})
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="4" width="22" height="16" rx="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg>
                        {{ ucfirst($booking->payment_status) }}
                    </div>

                </div>

                <div class="mt-6 flex justify-end">

                    <a
                        href="{{ route('bookings.show', $booking) }}"
                        class="bg-peony text-espresso px-5 py-2 rounded-lg hover:opacity-90 transition">

                        View Details

                    </a>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-peony/10 text-peony flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>

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

        <div class="flex items-center gap-3 mb-6">
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-peony/10 text-peony">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                </svg>
            </span>
            <h2 class="text-3xl font-bold text-peony">
                My Orders
            </h2>
        </div>

        @forelse($orders as $order)

            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">

                <div class="flex justify-between gap-4">

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

                    <span class="shrink-0 px-4 py-2 rounded-full text-sm font-semibold whitespace-nowrap {{ $status }}">

                        {{ ucfirst($order->order_status) }}

                    </span>

                </div>

                <div class="mt-6 space-y-3">

                    @foreach($order->items as $item)

                        <div class="flex justify-between text-gray-700">

                            <span>
                                {{ $item->product->name }}
                                <span class="text-gray-400">× {{ $item->quantity }}</span>
                            </span>

                            <span class="font-medium">
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
                       class="bg-peony text-espresso px-5 py-2 rounded-lg hover:opacity-90 transition">

                        View Details

                    </a>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

                <div class="mx-auto mb-4 w-14 h-14 rounded-full bg-peony/10 text-peony flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>

                <p class="text-gray-500">
                    You have no orders yet.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection