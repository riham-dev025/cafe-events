@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#faf8f5] min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <a href="{{ route('staff.dashboard') }}" class="inline-flex items-center gap-1.5 text-espresso/60 hover:text-espresso text-xs font-bold uppercase tracking-wider mb-4 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Hub
            </a>

            <div class="flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-peony/10 text-espresso shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </span>
                <div>
                    <h1 class="text-3xl font-serif text-espresso font-bold">Boutique Bookings</h1>
                    <p class="text-stone-500 text-sm mt-1">Check reservation lists and seat guest groupings.</p>
                </div>
            </div>
        </div>

        <!-- Bookings Table Card -->
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-peony/5 text-espresso/60 text-xs font-semibold uppercase tracking-wider border-b border-stone-100">
                            <th class="p-4 pl-6">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="4" y1="9" x2="20" y2="9"></line>
                                        <line x1="4" y1="15" x2="20" y2="15"></line>
                                        <line x1="10" y1="3" x2="8" y2="21"></line>
                                        <line x1="16" y1="3" x2="14" y2="21"></line>
                                    </svg>
                                    ID
                                </span>
                            </th>
                            <th class="p-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Attendee
                                </span>
                            </th>
                            <th class="p-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 13c3-6 13-6 16 0-2 1-4 1.5-8 1.5S6 14 4 13z"></path>
                                        <path d="M8 13.5V17m8-3.5V17"></path>
                                    </svg>
                                    Workshop/Session
                                </span>
                            </th>
                            <th class="p-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    Start Date
                                </span>
                            </th>
                            <th class="p-4">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    End Date
                                </span>
                            </th>
                            <th class="p-4 text-center">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                    Capacity
                                </span>
                            </th>
                            <th class="p-4 text-center">Booked</th>
                            <th class="p-4 text-center">Status</th>
                            <!-- <th class="p-4 pr-6 text-right">Created</th> -->
                            
                            <!-- <th class="p-4 pr-6 text-right">Created</th> -->
                           
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-peony/5 transition">
                                <td class="p-4 pl-6 font-mono text-stone-400">#{{ $booking->id }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-espresso">{{ $booking->user->name ?? 'N/A' }}</div>
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
                                <td colspan="8" class="p-12 text-center text-stone-400">
                                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-peony/10 text-peony mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </span>
                                    <p>No scheduled sessions active.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection