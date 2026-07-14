@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#faf8f5] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Cozy Header Area -->
        <div class="text-center mb-16">
            <span class="px-4 py-1.5 rounded-full bg-peony/30 text-espresso text-xs font-bold uppercase tracking-widest">
                Reserve a Moment
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-espresso mt-4 tracking-tight">
                Experience Nook & Peony
            </h1>
            <p class="text-stone-500 mt-2 max-w-md mx-auto text-sm md:text-base leading-relaxed">
                Reserve a cozy corner, book a coffee masterclass, or save a spot for our signature weekend brunches.
            </p>
            <div class="w-16 h-1 bg-peony mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Session Notifications -->
        @if(session('success'))
            <div class="max-w-3xl mx-auto mb-10 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl shadow-sm text-sm">
                ✨ {{ session('success') }}
            </div>
        @endif

        <!-- SECTION 1: Catalog of Experiences -->
        <div class="mb-16">
            <div class="mb-8">
                <h2 class="text-2xl font-black text-espresso tracking-tight">Our Curated Experiences</h2>
                <p class="text-xs text-stone-500 mt-1">Select one of our cozy offerings below to begin your reservation.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="group bg-white rounded-[2rem] border border-stone-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 overflow-hidden flex flex-col justify-between">
                        
                        <!-- Card Header Vibe -->
                        <div class="p-8 pb-4">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-wider rounded-full bg-peony/20 text-espresso border border-peony/30">
                                    {{ ucfirst($service->required_resource_type) }} Space
                                </span>
                                @if($service->price > 0)
                                    <span class="text-xl font-black text-espresso">${{ number_format($service->price, 2) }}</span>
                                @else
                                    <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Free Entry</span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-espresso group-hover:text-peony transition-colors duration-200">
                                {{ $service->name }}
                            </h3>
                            <p class="text-stone-500 text-xs mt-2 leading-relaxed">
                                {{ $service->description }}
                            </p>
                        </div>

                        <!-- Card Footer Details -->
                        <div class="p-8 pt-0 mt-4">
                            <div class="pt-6 border-t border-stone-50 flex items-center justify-between">
                                <span class="text-xs text-stone-400 font-bold tracking-wide">⏱ {{ $service->duration_minutes }} Mins</span>
                                <a href="{{ route('bookings.create', ['service_id' => $service->id]) }}" 
                                   class="inline-flex items-center px-5 py-3 bg-peony hover:bg-[#ebafc0] text-espresso text-xs font-black rounded-2xl shadow-sm transition-all duration-200 uppercase tracking-widest active:scale-95">
                                    Book Spot
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <hr class="border-stone-100 my-12" />

        <!-- SECTION 2: Booking History -->
        <div>
            <div class="mb-8">
                <h2 class="text-2xl font-black text-espresso tracking-tight">My Booking History</h2>
                <p class="text-xs text-stone-500 mt-1">Keep track of your upcoming and past cozy reservations.</p>
            </div>

            @if($bookings->isEmpty())
                <div class="bg-white rounded-[2rem] border border-stone-100 p-16 text-center shadow-sm max-w-xl mx-auto">
                    <span class="text-5xl block mb-4">📖</span>
                    <h3 class="text-xl font-bold text-espresso">No reservations yet</h3>
                    <p class="text-stone-500 text-xs mt-1">Select an experience above to plan your first visit to the nook!</p>
                </div>
            @else
                <div class="bg-white rounded-[2rem] border border-stone-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-stone-100 text-left">
                            <thead class="bg-[#faf8f5]">
                                <tr>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-espresso">Experience</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-espresso">Assigned Space</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-espresso">Date & Time</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-espresso text-center">Guests</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-espresso">Status</th>
                                    <th class="px-8 py-5 text-xs font-black uppercase tracking-wider text-espresso">Payment</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100 bg-white">
                                @foreach($bookings as $booking)
                                    <tr class="hover:bg-stone-50/50 transition-colors">
                                        <td class="px-8 py-6 font-bold text-espresso text-sm">
                                            {{ $booking->service?->name ?? 'Deleted Experience' }}
                                        </td>
                                        <td class="px-8 py-6 text-stone-600 text-xs">
                                            {{ $booking->resource?->name ?? 'No Space Assigned' }}
                                        </td>
                                        <td class="px-8 py-6 text-stone-600 text-xs">
                                            <span class="font-bold text-espresso block">
                                                {{ \Carbon\Carbon::parse($booking->booking_start)->format('M d, Y') }}
                                            </span>
                                            <span class="text-[10px] text-stone-400">
                                                {{ \Carbon\Carbon::parse($booking->booking_start)->format('h:i A') }} - 
                                                {{ \Carbon\Carbon::parse($booking->booking_end)->format('h:i A') }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-stone-600 text-xs text-center font-bold">
                                            {{ $booking->seats_reserved }}
                                        </td>
                                        <td class="px-8 py-6">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider 
                                                {{ $booking->booking_status === 'confirmed' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                                {{ $booking->booking_status }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-6 text-xs">
                                            <span class="text-stone-400 text-[10px] block uppercase tracking-wider">Pay at Shop</span>
                                            <span class="font-bold text-stone-600">{{ ucfirst($booking->payment_status) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection