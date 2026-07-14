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

        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-espresso tracking-tight">Order Registry</h1>
                    <p class="text-sm text-espresso/50 mt-1">Audit, search, and monitor every order placed at Nook & Peony.</p>
                </div>
            </div>

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
                                        <td class="p-5 font-bold text-espresso">#{{ $order->id }}</td>
                                        <td class="p-5">
                                            <p class="font-semibold text-espresso">{{ $order->user->name ?? 'Walk-in / Guest' }}</p>
                                            <p class="text-xs text-espresso/40">{{ $order->user->email ?? 'No Account' }}</p>
                                        </td>
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
                                        <td class="p-5 text-xs text-espresso/70">{{ $order->payment_method }}</td>
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
                                        <td class="p-5 text-xs text-espresso/60">{{ $order->created_at->format('M d, Y • h:i A') }}</td>
                                        <td class="p-5 font-extrabold text-espresso">${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-5 border-t border-peony/10">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection