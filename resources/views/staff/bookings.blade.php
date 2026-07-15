@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <a href="{{ route('staff.dashboard') }}" class="inline-flex items-center gap-1.5 text-stone-500 hover:text-amber-950 text-xs font-bold uppercase tracking-wider mb-2 transition">
                <span>←</span> Back to Hub
            </a>
            <h1 class="text-3xl font-serif text-amber-950 font-bold">Boutique Bookings</h1>
            <p class="text-amber-900/60 text-sm mt-1">Check reservation lists and seat guest groupings.</p>
        </div>

        <!-- Bookings Table Card -->
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50/50 text-stone-500 text-xs font-semibold uppercase tracking-wider border-b border-stone-100">
                            <th class="p-4 pl-6">ID</th>
                            <th class="p-4">Attendee</th>
                           <th class="p-4">Workshop/Session</th>
                            <th class="p-4">Start Date</th>
                            <th class="p-4">End Date</th>
                            <th class="p-4">Capacity</th>
                            <th class="p-4 text-center">Booked</th>
                            <th class="p-4 text-center">Status</th>
                            <!-- <th class="p-4 pr-6 text-right">Created</th> -->
                            
                            <!-- <th class="p-4 pr-6 text-right">Created</th> -->
                           
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-stone-50/30 transition">
                                <td class="p-4 pl-6 font-mono text-stone-400">#{{ $booking->id }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-amber-950">{{ $booking->user->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-stone-400">{{ $booking->user->email ?? '' }}</div>
                                </td>
                                <td class="p-4 font-medium text-stone-800">
                                    {{ $booking->service->name ?? 'Custom Creative Session' }}
                                </td>
                               <td class="p-4">
    {{ $booking->booking_start->format('M d, Y h:i A') }}
</td>

<td class="p-4">
    {{ $booking->booking_end->format('M d, Y h:i A') }}
</td>
<td class="p-4 text-center">
    {{ $booking->service->capacity }}
</td>
<td class="p-4 text-center">
    {{ $booking->bookedSeats }} / {{ $booking->service->capacity }}
</td>
                                <td class="p-4 text-center">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $booking->booking_status === 'Confirmed' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : '' }}
                                        {{ $booking->booking_status === 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                        {{ $booking->booking_status === 'Cancelled' ? 'bg-rose-50 text-rose-700 border border-rose-100' : '' }}">
                                        {{ $booking->booking_status }}
                                    </span>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-stone-400">No scheduled sessions active.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection