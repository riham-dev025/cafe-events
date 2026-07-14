<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- SECTION 1: Catalog of Available Services/Events -->
        <div class="mb-12">
            <div class="md:flex md:items-center md:justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Reserve an Experience</h2>
                    <p class="text-sm text-slate-500 mt-1">Book a cozy table, join a brewing masterclass, or rent our entire space.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($services as $service)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col justify-between overflow-hidden">
                        <div class="p-6">
                            <!-- Badge for warning thresholds -->
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                    {{ ucfirst($service->required_resource_type) }} Space
                                </span>
                                @if($service->price > 0)
                                    <span class="text-lg font-bold text-slate-800">${{ number_format($service->price, 2) }}</span>
                                @else
                                    <span class="text-sm font-semibold text-emerald-600 uppercase tracking-wider">Free Entry</span>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $service->name }}</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">{{ $service->description }}</p>
                        </div>

                        <div class="p-6 pt-0 border-t border-slate-50 bg-slate-50/50 flex items-center justify-between">
                            <span class="text-xs text-slate-500 font-medium">⏱ {{ $service->duration_minutes }} Mins</span>
                            <a href="{{ route('bookings.create', ['service_id' => $service->id]) }}" 
                               class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold rounded-lg shadow-sm transition-all">
                                Book Now
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <hr class="border-slate-100 my-10" />

        <!-- SECTION 2: Your Booking History -->
        <div>
            <h2 class="text-xl font-bold text-slate-800 mb-6">My Booking History</h2>

            @if($bookings->isEmpty())
                <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center shadow-sm">
                    <p class="text-slate-500 font-medium">You haven't made any bookings yet!</p>
                    <p class="text-xs text-slate-400 mt-1">Select an experience above to schedule your first visit.</p>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-100 text-left">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Service</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Assigned Space</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Date & Time</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Seats</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Payment</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($bookings as $booking)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $booking->service->name }}</td>
                                    <td class="px-6 py-4 text-slate-600 text-sm">{{ $booking->resource->name }}</td>
                                    <td class="px-6 py-4 text-slate-600 text-sm">
                                        {{ \Carbon\Carbon::parse($booking->booking_start)->format('M d, Y') }}<br>
                                        <span class="text-xs text-slate-400">
                                            {{ \Carbon\Carbon::parse($booking->booking_start)->format('h:i A') }} - 
                                            {{ \Carbon\Carbon::parse($booking->booking_end)->format('h:i A') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 text-sm">{{ $booking->seats_reserved }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold 
                                            {{ $booking->booking_status === 'confirmed' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                            {{ ucfirst($booking->booking_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="text-xs font-medium text-slate-500 block">Pay at Shop</span>
                                        <span class="text-slate-400 text-xs">{{ ucfirst($booking->payment_status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>