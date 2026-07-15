@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">


    {{-- Back Button --}}
    <a href="{{ route('profile.edit') }}"
       class="inline-flex items-center gap-1.5 text-peony hover:opacity-80 text-sm transition">

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

                <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-peony/10 text-peony shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </span>

                <div>

                    <h1 class="text-3xl font-bold text-espresso">

                        {{ $booking->service->name }}

                    </h1>


                    <p class="text-gray-500 mt-2">

                        Booking #{{ $booking->id }}

                    </p>

                </div>

            </div>



            {{-- Booking Status --}}
            @php

                $statusStyle = match($booking->booking_status){

                    'pending' =>
                    'bg-yellow-100 text-yellow-700',

                    'confirmed' =>
                    'bg-blue-100 text-blue-700',

                    'completed' =>
                    'bg-green-100 text-green-700',

                    'cancelled' =>
                    'bg-red-100 text-red-700',

                    default =>
                    'bg-gray-100 text-gray-700'

                };

            @endphp


            <span
                class="shrink-0 px-4 py-2 rounded-full font-semibold text-sm whitespace-nowrap {{ $statusStyle }}">

                {{ ucfirst($booking->booking_status) }}

            </span>


        </div>



        {{-- Booking Information --}}
        <div class="grid md:grid-cols-2 gap-6 mt-8">



            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Date
                </p>


                <p class="font-semibold mt-1 flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    {{ $booking->booking_start->format('F d, Y') }}

                </p>

            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Time
                </p>


                <p class="font-semibold mt-1 flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    {{ $booking->booking_start->format('h:i A') }}

                    -
                    
                    {{ $booking->booking_end->format('h:i A') }}

                </p>

            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Guests
                </p>


                <p class="font-semibold mt-1 flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    {{ $booking->seats_reserved }}
                    {{ Str::plural('Guest', $booking->seats_reserved) }}

                </p>

            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Assigned Table / Space
                </p>


                <p class="font-semibold mt-1 flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v-6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6"></path>
                        <path d="M2 17h20"></path>
                        <path d="M6 17v3"></path>
                        <path d="M18 17v3"></path>
                        <path d="M8 9V7a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    {{ $booking->resource->name ?? 'Not assigned' }}

                </p>

            </div>




        </div>




        {{-- Staff --}}
        <div class="mt-8 bg-[#FDF8F6] rounded-xl p-5">


            <p class="text-sm text-gray-500">
                Assigned Staff
            </p>


            <p class="font-semibold mt-1 flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                {{ $booking->staff?->user?->name ?? 'Not assigned yet' }}

                @if($booking->staff)

                    <span class="text-gray-500 text-sm">

                        ({{ ucfirst($booking->staff->position) }})

                    </span>

                @endif

            </p>


        </div>





        {{-- Payment --}}
        <div class="mt-6 grid md:grid-cols-2 gap-6">


            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Payment Method
                </p>


                <p class="font-semibold mt-1 flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    {{ ucfirst(str_replace('_',' ', $booking->payment_method)) }}

                </p>


            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Payment Status
                </p>


                <p class="font-semibold mt-1 flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 6v2m0 8v2"></path>
                        <path d="M15 9.5c0-1.4-1.34-2.5-3-2.5s-3 1.1-3 2.5 1.34 2 3 2 3 .6 3 2-1.34 2.5-3 2.5-3-1.1-3-2.5"></path>
                    </svg>
                    {{ ucfirst($booking->payment_status) }}

                </p>


            </div>


        </div>




        {{-- Notes --}}
        @if($booking->notes)

        <div class="mt-8">

            <p class="text-sm text-gray-500 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-peony shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                    <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z"></path>
                    <line x1="9" y1="13" x2="15" y2="13"></line>
                    <line x1="9" y1="17" x2="13" y2="17"></line>
                </svg>
                Notes
            </p>


            <div class="mt-2 bg-gray-50 rounded-xl p-4">

                {{ $booking->notes }}

            </div>


        </div>

        @endif





        {{-- Cancel Button --}}
       @if(in_array($booking->booking_status, ['pending','confirmed']))

<div class="mt-10 flex justify-end gap-4">


    {{-- Edit --}}
    <a href="{{ route('bookings.edit', $booking) }}"
       class="inline-flex items-center gap-2 bg-peony text-espresso px-6 py-3 rounded-lg hover:opacity-90 transition">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4z"></path>
        </svg>
        Edit Booking

    </a>



    {{-- Cancel --}}
    <form method="POST"
          action="{{ route('bookings.cancel',$booking) }}">

        @csrf
        @method('PATCH')


        <button
            class="inline-flex items-center gap-2 bg-red-500 text-white px-6 py-3 rounded-lg hover:opacity-90 transition"
            onclick="return confirm('Are you sure you want to cancel this booking?')">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            Cancel Booking

        </button>


    </form>


</div>

@endif



    </div>


</div>


@endsection