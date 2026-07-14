@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-serif text-amber-950 font-bold">Staff Portal</h1>
            <p class="text-amber-900/60 text-sm mt-1">Welcome back! Here is what's happening at the boutique today.</p>
        </div>

        <!-- Portal Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <!-- Orders Hub Card -->
            <div class="bg-white p-8 rounded-3xl border border-stone-100 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-2xl mb-4">📦</div>
                    <h3 class="text-xl font-serif font-bold text-amber-950 mb-1">Orders Desk</h3>
                    <p class="text-stone-500 text-sm mb-6">Fulfill client purchases, update processing statuses, and view purchase history.</p>
                </div>
                <a href="{{ route('staff.orders') }}" class="inline-flex justify-between items-center px-4 py-3 bg-amber-950 text-white rounded-xl text-xs font-semibold hover:bg-amber-900 transition">
                    Manage Orders <span>→</span>
                </a>
            </div>

            <!-- Bookings Hub Card -->
            <div class="bg-white p-8 rounded-3xl border border-stone-100 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-2xl mb-4">🌸</div>
                    <h3 class="text-xl font-serif font-bold text-amber-950 mb-1">Bookings & Events</h3>
                    <p class="text-stone-500 text-sm mb-6">Track guest registrations, check-in attendees, and manage daily service calendars.</p>
                </div>
                <a href="{{ route('staff.bookings') }}" class="inline-flex justify-between items-center px-4 py-3 bg-amber-950 text-white rounded-xl text-xs font-semibold hover:bg-amber-900 transition">
                    View Bookings <span>→</span>
                </a>
            </div>

            <!-- Inventory Desk Card -->
            <div class="bg-white p-8 rounded-3xl border border-stone-100 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="w-12 h-12 bg-stone-100 rounded-2xl flex items-center justify-center text-2xl mb-4">☕</div>
                    <h3 class="text-xl font-serif font-bold text-amber-950 mb-1">Stock & Inventory</h3>
                    <p class="text-stone-500 text-sm mb-6">Quickly monitor product stock counts and view catalog retail items.</p>
                </div>
                <a href="{{ route('staff.inventory') }}" class="inline-flex justify-between items-center px-4 py-3 bg-amber-950 text-white rounded-xl text-xs font-semibold hover:bg-amber-900 transition">
                    Open Stockroom <span>→</span>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection