@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-[#FDF8F6] text-espresso font-sans overflow-hidden">

    <!-- SIDEBAR (Include your sidebar here) -->

    <!-- MAIN BODY -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <!-- TOP BAR -->
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">
            <!-- Search Input (Form submitted on typing/enter) -->
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex items-center gap-4 w-1/3">
                <span class="text-espresso/40 text-lg">🔍</span>
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Order ID or Customer..." class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso" />
            </form>
            
            <div class="flex items-center gap-6 text-sm font-medium">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center">☕</div>
                    <span class="text-espresso/80">N&P Barista</span>
                </div>
            </div>
        </header>

        <!-- MAIN CONTAINER -->
        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">
            
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-espresso tracking-tight">Order Registry</h1>
                    <p class="text-sm text-espresso/50 mt-1">Audit, search, and monitor every order placed at Nook & Peony.</p>
                </div>
            </div>

            <!-- STATUS TABS (Subtle, elegant buttons matching theme colors) -->
            <div class="flex flex-wrap items-center gap-2 border-b border-peony/10 pb-4">
                @foreach(['All', 'Pending', 'Preparing', 'Completed', 'Cancelled'] as $tab)
                    @php
                        $isActive = $status === $tab;
                        $count = $counts[$tab] ?? null;
                    @endphp
                    <a href="{{ route('admin.orders.index', ['status' => $tab, 'search' => request('search')]) }}" 
                       class="px-4 py-2 text-xs font-semibold rounded-xl transition duration-150 flex items-center gap-2
                       {{ $isActive 
                            ? 'bg-espresso text-[#FDF8F6] shadow-sm' 
                            : 'bg-white text-espresso/60 border border-peony/10 hover:border-peony/30 hover:text-espresso' 
                       }}">
                        {{ $tab }}
                        @if($count !== null)
                            <span class="px-1.5 py-0.5 text-[10px] rounded-full {{ $isActive ? 'bg-[#FDF8F6]/20 text-white' : 'bg-peony/10 text-espresso/60' }}">
                                {{ $count }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>

            <!-- REGISTRY TABLE CARD -->
            <div class="bg-white rounded-2xl border border-peony/10 shadow-sm overflow-hidden">
                @if($orders->isEmpty())
                    <div class="p-16 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-peony/5 rounded-full flex items-center justify-center text-2xl mb-4">🔍</div>
                        <h3 class="font-bold text-espresso text-lg">No orders found</h3>
                        <p class="text-espresso/50 text-sm max-w-sm mt-1">No orders match your active filter status or search term.</p>
                        @if(request()->anyFilled(['status', 'search']))
                            <a href="{{ route('admin.orders.index') }}" class="mt-4 text-xs font-bold text-espresso hover:underline">Reset Filters</a>
                        @endif
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-peony/15 bg-peony/5 text-espresso/60 text-xs font-semibold uppercase tracking-wider">
                                    <th class="p-5">Order ID</th>
                                    <th class="p-5">Customer</th>
                                    <th class="p-5">Items</th>
                                    <th class="p-5">Method</th>
                                    <th class="p-5">Status</th>
                                    <th class="p-5">Placed At</th>
                                    <th class="p-5">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-peony/10 text-sm">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-peony/5 transition-colors">
                                        <!-- ID -->
                                        <td class="p-5 font-bold text-espresso">
                                            #{{ $order->id }}
                                        </td>
                                        
                                        <!-- Customer -->
                                        <td class="p-5">
                                            <p class="font-semibold text-espresso">{{ $order->user->name ?? 'Walk-in / Guest' }}</p>
                                            <p class="text-xs text-espresso/40">{{ $order->user->email ?? 'No Account' }}</p>
                                        </td>
                                        
                                        <!-- Items List -->
                                        <td class="p-5 max-w-xs">
                                            <div class="space-y-1">
                                                @foreach($order->items as $item)
                                                    <div class="flex items-center gap-1.5 text-xs text-espresso/70">
                                                        <span class="font-bold text-espresso/90">{{ $item->quantity }}x</span>
                                                        <span class="truncate">{{ $item->product->name }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        
                                        <!-- Payment Method -->
                                        <td class="p-5 text-xs text-espresso/70">
                                            {{ $order->payment_method }}
                                        </td>

                                        <!-- Elegant Status Badges -->
                                        <td class="p-5">
                                            <span class="px-2.5 py-1 text-[11px] font-semibold rounded-full border 
                                                @if($order->order_status === 'Pending') bg-amber-50 text-amber-700 border-amber-100/50
                                                @elseif($order->order_status === 'Preparing') bg-blue-50 text-blue-700 border-blue-100/50
                                                @elseif($order->order_status === 'Completed') bg-emerald-50 text-emerald-700 border-emerald-100/50
                                                @else bg-rose-50 text-rose-700 border-rose-100/50
                                                @endif">
                                                {{ $order->order_status }}
                                            </span>
                                        </td>

                                        <!-- Date Placed -->
                                        <td class="p-5 text-xs text-espresso/60">
                                            {{ $order->created_at->format('M d, Y • h:i A') }}
                                        </td>

                                        <!-- Total Price -->
                                        <td class="p-5 font-extrabold text-espresso">
                                            ${{ number_format($order->total_amount, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Link Setup -->
                    <div class="p-5 border-t border-peony/10">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>

        </div>
    </main>
</div>
@endsection