@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-6 py-10">


<h1 class="text-3xl font-bold mb-8">
    Edit Booking
</h1>



<div class="bg-white shadow-lg rounded-2xl p-8">


<form method="POST"
      action="{{ route('bookings.update',$booking) }}">

@csrf
@method('PATCH')



{{-- Service locked --}}

<div class="mb-6">

<label class="block mb-2 font-medium">
    Service
</label>


<input
value="{{ $booking->service->name }}"
disabled
class="w-full border rounded-lg px-4 py-3 bg-gray-100">

</div>




{{-- Date --}}

<div class="mb-6">

<label class="block mb-2 font-medium">
    Date
</label>


<input
type="date"
name="booking_date"
value="{{ $booking->booking_start->format('Y-m-d') }}"
class="w-full border rounded-lg px-4 py-3">


</div>





{{-- Time --}}

<div class="mb-6">

<label class="block mb-2 font-medium">
    Time
</label>


<input
type="time"
name="start_time"
value="{{ $booking->booking_start->format('H:i') }}"
class="w-full border rounded-lg px-4 py-3">


</div>





{{-- Guests --}}

<div class="mb-6">

<label class="block mb-2 font-medium">
    Guests
</label>


<input
type="number"
name="seats_reserved"
value="{{ $booking->seats_reserved }}"
min="1"
class="w-full border rounded-lg px-4 py-3">


</div>






{{-- Resource --}}

<div class="mb-6">

<label class="block mb-2 font-medium">
    Table / Space
</label>


<select
name="resource_id"
class="w-full border rounded-lg px-4 py-3">


@foreach($resources as $resource)

<option value="{{ $resource->id }}"
@if($booking->resource_id == $resource->id)
selected
@endif
>

{{ $resource->name }}

</option>


@endforeach


</select>

</div>





<button
class="bg-peony text-espresso px-6 py-3 rounded-lg">

Save Changes

</button>


</form>


</div>


</div>

@endsection