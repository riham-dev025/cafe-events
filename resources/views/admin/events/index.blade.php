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
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
                    <span class="text-emerald-500 text-xl">✓</span>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-espresso tracking-tight">Events & Services Catalog</h1>
                    <p class="text-sm text-espresso/50 mt-1">Manage workshop schedules, service capacities, and pricing models.</p>
                </div>
                <a href="{{ route('admin.events.create') }}" class="px-5 py-3 bg-espresso text-white rounded-2xl text-sm font-semibold hover:bg-espresso/90 shadow-md transition flex items-center gap-2">
                    <span class="text-lg leading-none">+</span> Add New Event
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($events as $event)
                    <div class="bg-white rounded-3xl border border-peony/10 shadow-sm overflow-hidden flex flex-col h-full justify-between">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <span class="bg-peony/20 text-espresso text-xs px-3 py-1.5 rounded-xl font-bold">
                                    Capacity: {{ $event->capacity }} Guests
                                </span>
                                <span class="text-lg font-bold text-espresso">${{ number_format($event->price, 2) }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-espresso mb-2">{{ $event->name }}</h3>
                            <p class="text-espresso/60 text-sm leading-relaxed line-clamp-3">
                                {{ $event->description ?? 'No details provided.' }}
                            </p>
                        </div>

                        <div class="px-6 py-4 bg-peony/5 border-t border-peony/10 flex justify-between items-center">
                            <a href="{{ route('admin.events.edit', $event->id) }}" class="text-espresso hover:text-espresso/80 text-sm font-bold transition">
                                Edit Details
                            </a>
                            <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This will remove this service option.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-espresso/50 hover:text-rose-600 text-sm font-semibold transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-3xl border border-peony/10 p-12 text-center text-espresso/40">
                        No events or services found. Click "Add New Event" to get started.
                    </div>
                @endforelse
            </div>

            @if($events->hasPages())
                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
@endsection