@extends('layouts.app')

@section('content')
<div class="py-12 bg-amber-50/30 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <a href="{{ route('staff.dashboard') }}" class="inline-flex items-center gap-1.5 text-stone-500 hover:text-amber-950 text-xs font-bold uppercase tracking-wider mb-2 transition">
                <span>←</span> Back to Hub
            </a>
            <h1 class="text-3xl font-serif text-amber-950 font-bold">Orders Management</h1>
            <p class="text-amber-900/60 text-sm mt-1">Review shop transactions and coordinate order fulfillments.</p>
        </div>

        <!-- Orders Table Card -->
        <div class="bg-white rounded-3xl border border-stone-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50/50 text-stone-500 text-xs font-semibold uppercase tracking-wider border-b border-stone-100">
                            <th class="p-4 pl-6">Order ID</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Total Price</th>
                            <th class="p-4">Payment Method</th>
                            <th class="p-4 text-center">Status</th>
                            <th class="p-4 pr-6 text-right">Date Placed</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-sm text-stone-700">
                        @forelse($orders as $order)
                            <tr class="hover:bg-stone-50/30 transition">
                                <td class="p-4 pl-6 font-mono text-stone-400">#{{ $order->id }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-amber-950">{{ $order->user->name ?? 'Guest Client' }}</div>
                                    <div class="text-xs text-stone-400">{{ $order->user->email ?? 'N/A' }}</div>
                                </td>
                                <td class="p-4 font-semibold text-stone-900">
                                    ${{ number_format($order->total ?? $order->price ?? 0, 2) }}
                                </td>
                                <td class="p-4 text-stone-500 font-mono text-xs uppercase">
                                    {{ $order->payment_method ?? 'Stripe' }}
                                </td>
                                <td class="p-4 text-center">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ ($order->status ?? 'Completed') === 'Completed' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                        {{ $order->status ?? 'Completed' }}
                                    </span>
                                </td>
                                <td class="p-4 pr-6 text-right text-xs text-stone-400">
                                    {{ $order->created_at->format('M d, Y \a\t g:i A') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-stone-400">No client orders recorded.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection