@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-10">


    {{-- Back Button --}}
    <a href="{{ route('profile.edit') }}"
       class="text-peony hover:opacity-80 text-sm">

        ← Back to Profile

    </a>



    <div class="mt-6 bg-white rounded-3xl shadow-lg p-8">


        {{-- Header --}}
        <div class="flex justify-between items-start border-b pb-6">


            <div>

                <h1 class="text-3xl font-bold text-espresso">

                    {{ $booking->service->name }}

                </h1>


                <p class="text-gray-500 mt-2">

                    Booking #{{ $booking->id }}

                </p>


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
                class="px-4 py-2 rounded-full font-semibold text-sm {{ $statusStyle }}">

                {{ ucfirst($booking->booking_status) }}

            </span>


        </div>



        {{-- Booking Information --}}
        <div class="grid md:grid-cols-2 gap-6 mt-8">



            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Date
                </p>


                <p class="font-semibold mt-1">

                    📅
                    {{ $booking->booking_start->format('F d, Y') }}

                </p>

            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Time
                </p>


                <p class="font-semibold mt-1">

                    🕒
                    {{ $booking->booking_start->format('h:i A') }}

                    -
                    
                    {{ $booking->booking_end->format('h:i A') }}

                </p>

            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Guests
                </p>


                <p class="font-semibold mt-1">

                    👥
                    {{ $booking->seats_reserved }}
                    {{ Str::plural('Guest', $booking->seats_reserved) }}

                </p>

            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Assigned Table / Space
                </p>


                <p class="font-semibold mt-1">

                    🪑
                    {{ $booking->resource->name ?? 'Not assigned' }}

                </p>

            </div>




        </div>




        {{-- Staff --}}
        <div class="mt-8 bg-[#FDF8F6] rounded-xl p-5">


            <p class="text-sm text-gray-500">
                Assigned Staff
            </p>


            <p class="font-semibold mt-1">

                👩
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


                <p class="font-semibold mt-1">

                    💳
                    {{ ucfirst(str_replace('_',' ', $booking->payment_method)) }}

                </p>


            </div>




            <div class="bg-[#FDF8F6] rounded-xl p-5">

                <p class="text-sm text-gray-500">
                    Payment Status
                </p>


                <p class="font-semibold mt-1">

                    💰
                    {{ ucfirst($booking->payment_status) }}

                </p>


            </div>


        </div>




        {{-- Notes --}}
        @if($booking->notes)

        <div class="mt-8">

            <p class="text-sm text-gray-500">
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
       class="bg-peony text-espresso px-6 py-3 rounded-lg hover:opacity-90">

        Edit Booking

    </a>



    {{-- Cancel --}}
    <form method="POST"
          action="{{ route('bookings.cancel',$booking) }}">

        @csrf
        @method('PATCH')


        <button
            class="bg-red-500 text-white px-6 py-3 rounded-lg hover:opacity-90"
            onclick="return confirm('Are you sure you want to cancel this booking?')">

            Cancel Booking

        </button>


    </form>


</div>

@endif



    </div>


</div>


@endsection