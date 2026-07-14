@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif text-amber-950 font-bold">Bookings Management</h1>
                <p class="text-amber-900/60 text-sm mt-1">Monitor appointments, filter by status, and manage user schedules.</p>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @foreach($counts as $key => $count)
                <div class="bg-white p-5 rounded-2xl border border-stone-100 shadow-sm">
                    <span class="text-xs font-semibold text-stone-400 uppercase tracking-wider">{{ $key }} Bookings</span>
                    <h3 class="text-2xl font-bold text-amber-950 mt-1">{{ $count }}</h3>
                </div>
            @endforeach
        </div>

        <!-- Main Filter & Table Card -->
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">
            
            <!-- Filter and Search Header -->
            <div class="p-6 border-b border-stone-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <!-- Status Filter Tabs -->
                <div class="flex bg-stone-100 p-1 rounded-xl">
                    @foreach(['All', 'Pending', 'Confirmed', 'Cancelled'] as $tab)
                        <a href="{{ route('admin.bookings.index', ['status' => $tab, 'search' => request('search')]) }}" 
                           class="px-4 py-2 text-xs font-medium rounded-lg transition-all {{ $status === $tab ? 'bg-white text-amber-950 shadow-sm' : 'text-stone-500 hover:text-amber-950' }}">
                            {{ $tab }}
                        </a>
                    @endforeach
                </div>

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.bookings.index') }}" class="w-full md:w-80 flex gap-2">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer or ID..." 
                           class="w-full text-sm rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500 placeholder-stone-400">
                    <button type="submit" class="px-4 py-2 bg-amber-950 text-white rounded-xl text-xs font-semibold hover:bg-amber-900 transition">Search</button>
                </form>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50/50 text-stone-500 text-xs font-semibold uppercase tracking-wider border-b border-stone-100">
                            <th class="p-4 pl-6">ID</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Event / Service</th>
                            <th class="p-4">Date & Time</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 pr-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-stone-50/30 transition">
                                <td class="p-4 pl-6 font-mono text-stone-400">#{{ $booking->id }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-amber-950">{{ $booking->user->name }}</div>
                                    <div class="text-xs text-stone-400">{{ $booking->user->email }}</div>
                                </td>
                                <td class="p-4 font-medium text-stone-800">{{ $booking->service->name ?? 'Custom Session' }}</td>
                                <td class="p-4">
                                    {{ $booking->booking_date ?? 'N/A' }}
                                    <span class="block text-xs text-stone-400">{{ $booking->booking_time ?? '' }}</span>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $booking->booking_status === 'Confirmed' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : '' }}
                                        {{ $booking->booking_status === 'Pending' ? 'bg-amber-50 text-amber-700 border border-amber-100' : '' }}
                                        {{ $booking->booking_status === 'Cancelled' ? 'bg-rose-50 text-rose-700 border border-rose-100' : '' }}">
                                        {{ $booking->booking_status }}
                                    </span>
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    @if($booking->booking_status !== 'Cancelled')
                                        <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Cancel this booking?')" class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xs text-rose-600 font-semibold hover:underline">Cancel Booking</button>
                                        </form>
                                    @else
                                        <span class="text-xs text-stone-400 italic">No Actions</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-stone-400">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($bookings->hasPages())
                <div class="p-6 border-t border-stone-100">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection