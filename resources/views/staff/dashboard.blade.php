@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#FDF8F6] min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex items-center gap-3">
            <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-peony/20 text-espresso shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </span>
            <div>
                <h1 class="text-3xl font-serif text-espresso font-bold">Staff Portal</h1>
                <p class="text-espresso/60 text-sm mt-1">Welcome back! Here is what's happening at the boutique today.</p>
            </div>
        </div>

        <!-- Portal Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Orders Hub Card -->
            <div class="group bg-white p-8 rounded-3xl border border-peony/10 shadow-sm flex flex-col justify-between hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div>
                    <div class="w-12 h-12 bg-peony/20 rounded-2xl flex items-center justify-center text-espresso mb-4 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 12H7L6 8zM9 8V6a3 3 0 116 0v2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-espresso mb-1">Orders Desk</h3>
                    <p class="text-espresso/50 text-sm mb-6">Fulfill client purchases, update processing statuses, and view purchase history.</p>
                </div>
                <a href="{{ route('staff.orders') }}" class="inline-flex justify-between items-center px-4 py-3 bg-espresso text-white rounded-xl text-xs font-semibold hover:bg-espresso/90 transition">
                    Manage Orders
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7M21 12H3" />
                    </svg>
                </a>
            </div>

            <!-- Bookings Hub Card -->
            <div class="group bg-white p-8 rounded-3xl border border-peony/10 shadow-sm flex flex-col justify-between hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div>
                    <div class="w-12 h-12 bg-peony/20 rounded-2xl flex items-center justify-center text-espresso mb-4 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12v16l-6-4-6 4V4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-espresso mb-1">Bookings &amp; Events</h3>
                    <p class="text-espresso/50 text-sm mb-6">Track guest registrations, check-in attendees, and manage daily service calendars.</p>
                </div>
                <a href="{{ route('staff.bookings') }}" class="inline-flex justify-between items-center px-4 py-3 bg-espresso text-white rounded-xl text-xs font-semibold hover:bg-espresso/90 transition">
                    View Bookings
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7M21 12H3" />
                    </svg>
                </a>
            </div>

            <!-- Inventory Desk Card -->
            <div class="group bg-white p-8 rounded-3xl border border-peony/10 shadow-sm flex flex-col justify-between hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div>
                    <div class="w-12 h-12 bg-peony/20 rounded-2xl flex items-center justify-center text-espresso mb-4 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 13c3-6 13-6 16 0-2 1-4 1.5-8 1.5S6 14 4 13z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 13.5V17m8-3.5V17" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-serif font-bold text-espresso mb-1">Stock &amp; Inventory</h3>
                    <p class="text-espresso/50 text-sm mb-6">Quickly monitor product stock counts and view catalog retail items.</p>
                </div>
                <a href="{{ route('staff.inventory') }}" class="inline-flex justify-between items-center px-4 py-3 bg-espresso text-white rounded-xl text-xs font-semibold hover:bg-espresso/90 transition">
                    Open Stockroom
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7-7 7M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection