@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <a href="{{ route('staff.dashboard') }}" class="inline-flex items-center gap-1.5 text-stone-500 hover:text-amber-950 text-xs font-bold uppercase tracking-wider mb-2 transition">
                <span>←</span> Back to Hub
            </a>
            <h1 class="text-3xl font-serif text-amber-950 font-bold">Stock & Inventory</h1>
            <p class="text-amber-900/60 text-sm mt-1">Review retail levels, catalog items, and track availability statuses.</p>
        </div>

        <!-- Inventory List Card -->
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50/50 text-stone-500 text-xs font-semibold uppercase tracking-wider border-b border-stone-100">
                            <th class="p-4 pl-6">Product Item</th>
                            <th class="p-4">SKU / ID</th>
                            <th class="p-4 text-center">Current Stock</th>
                            <th class="p-4">Base Cost</th>
                            <th class="p-4 pr-6 text-right">Shop Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                        @forelse($products as $product)
                            <tr class="hover:bg-stone-50/30 transition">
                                <td class="p-4 pl-6 font-serif font-bold text-amber-950 text-base">
                                    {{ $product->name }}
                                </td>
                                <td class="p-4 font-mono text-stone-400 text-xs">
                                    #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="p-4 text-center">
                                    <!-- Dynamic low stock alert logic -->
                                    @php
                                        $stock = $product->stock ?? 0;
                                    @endphp
                                    @if($stock <= 3)
                                        <span class="inline-flex items-center gap-1.5 text-rose-600 font-bold bg-rose-50 px-2.5 py-1 rounded-xl text-xs border border-rose-100 animate-pulse">
                                            ⚠️ {{ $stock }} left (Low)
                                        </span>
                                    @else
                                        <span class="text-stone-700 font-semibold text-sm">
                                            {{ $stock }} units
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 font-semibold text-stone-900">
                                    ${{ number_format($product->price, 2) }}
                                </td>
                                <td class="p-4 pr-6 text-right">
                                    <span class="inline-flex px-2 py-1 rounded-lg text-xs font-bold uppercase tracking-wider
                                        {{ $product->is_available ? 'text-emerald-700 bg-emerald-50' : 'text-stone-400 bg-stone-100' }}">
                                        {{ $product->is_available ? 'Available' : 'Hidden' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-stone-400">No items detected in database catalog.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection