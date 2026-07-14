@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-[#FDF8F6] text-espresso font-sans overflow-hidden">
    <aside class="w-64 bg-white border-r border-peony/20 flex flex-col justify-between shrink-0">
        <div>
            <div class="p-6 border-b border-peony/10 flex items-center gap-3">
                <div class="h-10 w-10 bg-peony/20 rounded-xl flex items-center justify-center text-espresso font-bold text-lg">🌸</div>
                <div>
                    <h2 class="font-bold text-espresso text-base tracking-tight">Nook & Peony</h2>
                    <span class="text-xs text-espresso/40">RestroPanel v1.0</span>
                </div>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">📊</span> Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">🛍️</span> Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">🍰</span> Products
                </a>
                <a href="{{ route('admin.events.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">📅</span> Events
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.bookings.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <span class="text-lg transition-transform duration-200 group-hover:scale-110">🌸</span> Bookings
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-peony/10 bg-peony/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-espresso text-white rounded-full flex items-center justify-center font-bold text-sm">AD</div>
                <div>
                    <p class="text-sm font-semibold text-espresso">Admin Account</p>
                    <p class="text-xs text-espresso/40">Role: Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-xl border border-peony/30 bg-white px-3 py-2 text-sm font-semibold text-espresso/70 transition-all duration-200 hover:-translate-y-0.5 hover:bg-peony/10 hover:text-espresso">
                    <span class="text-base transition-transform duration-200 group-hover:scale-110">🚪</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-4 w-1/3">
                <span class="text-espresso/40 text-lg">🔍</span>
                <input type="text" placeholder="Search anything..." class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso" />
            </div>

            <div class="flex items-center gap-6 text-sm font-medium">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center">☕</div>
                    <span class="text-espresso/80">N&P Barista</span>
                </div>
            </div>
        </header>

        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-espresso tracking-tight">Bookings Management</h1>
                    <p class="text-sm text-espresso/50 mt-1">Monitor appointments, filter by status, and manage user schedules.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                @foreach($counts as $key => $count)
                    <div class="bg-white p-5 rounded-2xl border border-peony/10 shadow-sm">
                        <span class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">{{ $key }} Bookings</span>
                        <h3 class="text-2xl font-bold text-espresso mt-1">{{ $count }}</h3>
                    </div>
                @endforeach
            </div>

            <div class="bg-white rounded-2xl border border-peony/10 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-peony/10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex bg-peony/10 p-1 rounded-xl">
                        @foreach(['All', 'Pending', 'Confirmed', 'Cancelled'] as $tab)
                            <a href="{{ route('admin.bookings.index', ['status' => $tab, 'search' => request('search')]) }}"
                               class="px-4 py-2 text-xs font-medium rounded-lg transition-all {{ $status === $tab ? 'bg-white text-espresso shadow-sm' : 'text-espresso/60 hover:text-espresso' }}">
                                {{ $tab }}
                            </a>
                        @endforeach
                    </div>

                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="w-full md:w-80 flex gap-2">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search customer or ID..."
                               class="w-full text-sm rounded-xl border border-peony/20 focus:border-peony focus:ring-peony/20 placeholder-espresso/30">
                        <button type="submit" class="px-4 py-2 bg-espresso text-white rounded-xl text-xs font-semibold hover:bg-espresso/90 transition">Search</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-peony/5 text-espresso/60 text-xs font-semibold uppercase tracking-wider border-b border-peony/10">
                                <th class="p-4 pl-6">ID</th>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Event / Service</th>
                                <th class="p-4">Date & Time</th>
                                <th class="p-4 text-center">Status</th>
                                <th class="p-4 pr-6 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-peony/10 text-sm text-espresso/70">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-peony/5 transition">
                                    <td class="p-4 pl-6 font-mono text-espresso/40">#{{ $booking->id }}</td>
                                    <td class="p-4">
                                        <div class="font-semibold text-espresso">{{ $booking->user->name }}</div>
                                        <div class="text-xs text-espresso/40">{{ $booking->user->email }}</div>
                                    </td>
                                    <td class="p-4 font-medium text-espresso">{{ $booking->service->name ?? 'Custom Session' }}</td>
                                    <td class="p-4">
                                        {{ $booking->booking_date ?? 'N/A' }}
                                        <span class="block text-xs text-espresso/40">{{ $booking->booking_time ?? '' }}</span>
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
                                            <span class="text-xs text-espresso/40 italic">No Actions</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-espresso/40">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($bookings->hasPages())
                    <div class="p-6 border-t border-peony/10">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection