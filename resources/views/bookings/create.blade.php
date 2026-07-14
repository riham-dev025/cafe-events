@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#faf8f5] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        <!-- Form Container Card -->
        <div class="bg-white rounded-[2rem] border border-stone-100 shadow-xl overflow-hidden p-8 md:p-12">
            
            <!-- Form Header -->
            <div class="mb-10 text-center md:text-left">
                <a href="{{ route('bookings.index') }}" class="inline-block text-[10px] font-black text-peony hover:text-[#ebafc0] transition-colors uppercase tracking-widest">
                    ← Back to Experience Registry
                </a>
                <h2 class="text-3xl font-black text-espresso tracking-tight mt-4">Confirm Reservation</h2>
                <p class="text-stone-500 text-xs mt-1">Please enter your desired reservation details below to save your spot in our nook.</p>
                <div class="w-12 h-1 bg-peony mt-4 rounded-full mx-auto md:mx-0"></div>
            </div>

            <!-- Warm Cozy Error Alerts -->
            @if($errors->any())
                <div class="mb-8 p-5 bg-rose-50/80 border border-rose-100 text-rose-800 rounded-2xl shadow-sm">
                    <strong class="font-bold text-xs uppercase tracking-wider block mb-2">We couldn't secure this slot:</strong>
                    <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- 1. Select Service -->
                <div>
                    <label for="service_id" class="block text-xs font-black text-espresso uppercase tracking-widest mb-2">Select Experience</label>
                    <select name="service_id" id="service_id" 
                            class="w-full rounded-2xl border-stone-200 bg-stone-50/30 text-stone-700 shadow-sm focus:border-peony focus:ring-peony py-3 px-4 text-sm">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ (old('service_id') ?? $selectedServiceId) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} ({{ $service->duration_minutes }} mins)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date & Time Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- 2. Date Input -->
                    <div>
                        <label for="booking_date" class="block text-xs font-black text-espresso uppercase tracking-widest mb-2">Reservation Date</label>
                        <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date', date('Y-m-d')) }}"
                               class="w-full rounded-2xl border-stone-200 bg-stone-50/30 text-stone-700 shadow-sm focus:border-peony focus:ring-peony py-3 px-4 text-sm">
                    </div>

                    <!-- 3. Start Time Input -->
                    <div>
                        <label for="start_time" class="block text-xs font-black text-espresso uppercase tracking-widest mb-2">Arrival Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', '14:00') }}"
                               class="w-full rounded-2xl border-stone-200 bg-stone-50/30 text-stone-700 shadow-sm focus:border-peony focus:ring-peony py-3 px-4 text-sm">
                    </div>

                </div>

                <!-- 4. Seats Reserved (Number of Guests) -->
                <div>
                    <label for="seats_reserved" class="block text-xs font-black text-espresso uppercase tracking-widest mb-2">Guests joining us</label>
                    <input type="number" name="seats_reserved" id="seats_reserved" min="1" value="{{ old('seats_reserved', 2) }}"
                           class="w-full rounded-2xl border-stone-200 bg-stone-50/30 text-stone-700 shadow-sm focus:border-peony focus:ring-peony py-3 px-4 text-sm">
                    <p class="text-[10px] text-stone-400 mt-1">Let us know how many guests will need seats during your visit.</p>
                </div>

                <!-- 5. Optional Notes -->
                <div>
                    <label for="notes" class="block text-xs font-black text-espresso uppercase tracking-widest mb-2">Special Requests (Optional)</label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Allergies, high chair requests, or birthday surprises go here..."
                              class="w-full rounded-2xl border-stone-200 bg-stone-50/30 text-stone-700 shadow-sm focus:border-peony focus:ring-peony py-3 px-4 text-sm"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-4 bg-peony hover:bg-[#ebafc0] text-espresso font-black text-xs rounded-2xl shadow-md hover:shadow-lg transition-all duration-200 uppercase tracking-widest text-center active:scale-95">
                    Confirm & Save Booking
                </button>
            </form>

        </div>
    </div>
</div>
@endsection