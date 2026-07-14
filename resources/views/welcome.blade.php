@extends('layouts.app')


@section('content')


<div class="bg-espresso text-center px-8 py-16">

    <p class="text-peony text-sm mb-3">
        Coffee, desserts, and moments worth booking
    </p>


    <h1 class="text-white text-3xl font-medium max-w-lg mx-auto mb-4">
        A slow morning or a night to remember
    </h1>


    <p class="text-peony/80 text-base max-w-md mx-auto mb-7">
        Order from our menu or reserve one of our signature experiences.
    </p>


    <div class="flex gap-3 justify-center">

        <a href="{{ route('products.index') }}"
           class="bg-peony text-espresso text-sm font-medium px-6 py-3 rounded-lg">
            Order online
        </a>


        <a href="{{ route('bookings.create') }}"
           class="border border-peony text-peony text-sm font-medium px-6 py-3 rounded-lg">
            Book an experience
        </a>

    </div>

</div>