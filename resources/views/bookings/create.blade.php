<x-app-layout>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden p-8 md:p-10">
            
            <div class="mb-8">
                <a href="{{ route('bookings.index') }}" class="text-xs font-bold text-slate-400 hover:text-slate-600 transition-colors uppercase tracking-widest">← Back to Index</a>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight mt-4">Confirm Reservation Details</h2>
                <p class="text-sm text-slate-500 mt-1">Please enter your desired reservation date, starting time, and guest count.</p>
            </div>

            <!-- Error Alerts for Double-Bookings/Full Capacity -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-lg shadow-sm">
                    <strong class="font-bold text-sm block mb-1">We couldn't book this slot:</strong>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <!-- 1. Select Service -->
                <div class="mb-6">
                    <label for="service_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Select Experience</label>
                    <select name="service_id" id="service_id" class="w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ (old('service_id') ?? $selectedServiceId) == $service->id ? 'selected' : '' }}>
                                {{ $service->name }} ({{ $service->duration_minutes }} mins)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- 2. Date Input -->
                    <div>
                        <label for="booking_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Reservation Date</label>
                        <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date', date('Y-m-d')) }}"
                               class="w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    </div>

                    <!-- 3. Start Time Input -->
                    <div>
                        <label for="start_time" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Arrival Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', '14:00') }}"
                               class="w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                    </div>
                </div>

                <!-- 4. Seats Reserved (Number of Guests) -->
                <div class="mb-6">
                    <label for="seats_reserved" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Seats to Reserve</label>
                    <input type="number" name="seats_reserved" id="seats_reserved" min="1" value="{{ old('seats_reserved', 2) }}"
                           class="w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                </div>

                <!-- 5. Optional Notes -->
                <div class="mb-8">
                    <label for="notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Special Requests (Optional)</label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Tell us about allergies, preferred spaces, or special requirements..."
                              class="w-full rounded-xl border-slate-200 shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-sm rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 uppercase tracking-widest text-center">
                    Confirm & Complete Booking
                </button>
            </form>

        </div>
    </div>
</x-app-layout>