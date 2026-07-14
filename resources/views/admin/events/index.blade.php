@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
                <span class="text-emerald-500 text-xl">✓</span>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-serif text-amber-950 font-bold">Events & Services Catalog</h1>
                <p class="text-amber-900/60 text-sm mt-1">Manage workshop schedules, service capacities, and pricing models.</p>
            </div>
            <a href="{{ route('admin.events.create') }}" class="px-5 py-3 bg-amber-950 text-white rounded-2xl text-sm font-semibold hover:bg-amber-900 shadow-md transition flex items-center gap-2">
                <span class="text-lg leading-none">+</span> Add New Event
            </a>
        </div>

        <!-- Grid of Events -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($events as $event)
                <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden flex flex-col h-full justify-between">
                    <div class="p-6">
                        <!-- Upper Badge Row -->
                        <div class="flex justify-between items-start mb-4">
                            <span class="bg-amber-50 text-amber-950 text-xs px-3 py-1.5 rounded-xl font-bold">
                                Capacity: {{ $event->capacity }} Guests
                            </span>
                            <span class="text-lg font-serif font-bold text-amber-950">
                                ${{ number_format($event->price, 2) }}
                            </span>
                        </div>

                        <h3 class="text-xl font-serif font-bold text-amber-950 mb-2">{{ $event->name }}</h3>
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-3">
                            {{ $event->description ?? 'No details provided.' }}
                        </p>
                    </div>

                    <!-- Action Footer -->
                    <div class="px-6 py-4 bg-stone-50/50 border-t border-stone-100 flex justify-between items-center">
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="text-amber-950 hover:text-amber-800 text-sm font-bold transition">
                            Edit Details
                        </a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you absolutely sure? This will remove this service option.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-stone-400 hover:text-rose-600 text-sm font-semibold transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white rounded-3xl border border-stone-100 p-12 text-center text-stone-400">
                    No events or services found. Click "Add New Event" to get started.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="mt-8">
                {{ $events->links() }}
            </div>
        @endif

    </div>
</div>
@endsection