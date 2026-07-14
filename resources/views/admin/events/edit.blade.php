@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        
        <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 text-stone-500 hover:text-amber-950 text-sm font-semibold mb-6 transition">
            <span>←</span> Back to Catalog
        </a>

        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm p-8">
            <h2 class="text-2xl font-serif font-bold text-amber-950 mb-2">Modify Event Details</h2>
            <p class="text-stone-400 text-sm mb-8">Update pricing, information and structures. Changes will sync immediately.</p>

            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-stone-500 mb-2">Event Title</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $event->name) }}"
                           class="w-full text-sm rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                    @error('name') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="description" class="block text-xs font-semibold uppercase tracking-wider text-stone-500 mb-2">Event Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full text-sm rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500">{{ old('description', $event->description) }}</textarea>
                    @error('description') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="price" class="block text-xs font-semibold uppercase tracking-wider text-stone-500 mb-2">Price ($)</label>
                        <input type="number" step="0.01" name="price" id="price" required value="{{ old('price', $event->price) }}"
                               class="w-full text-sm rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                        @error('price') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="capacity" class="block text-xs font-semibold uppercase tracking-wider text-stone-500 mb-2">Max Capacity</label>
                        <input type="number" name="capacity" id="capacity" required value="{{ old('capacity', $event->capacity) }}"
                               class="w-full text-sm rounded-xl border-stone-200 focus:border-amber-500 focus:ring-amber-500">
                        @error('capacity') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button type="submit" class="w-full mt-4 py-4 bg-amber-950 text-white rounded-2xl text-sm font-semibold hover:bg-amber-900 shadow-md transition">
                    Save Event Changes
                </button>
            </form>
        </div>

    </div>
</div>
@endsection