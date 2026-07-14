@extends('layouts.app')

@section('content')
<!-- ChartJS CDN for rendering our beautiful data sets -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="flex h-screen bg-[#FDF8F6] text-espresso font-sans overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-peony/20 flex flex-col justify-between shrink-0">
        <div>
            <!-- Logo Section -->
            <div class="p-6 border-b border-peony/10 flex items-center gap-3">
                <div class="h-10 w-10 bg-peony/20 rounded-xl flex items-center justify-center text-espresso">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c1 2-1 3-1 5a3 3 0 106 0c0-2-2-3-1-5-3 0-4 2-4 5" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 13h9a3 3 0 013 3 3 3 0 01-3 3H8a3 3 0 01-3-3v-3z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-espresso text-base tracking-tight">Nook &amp; Peony</h2>
                    <span class="text-xs text-espresso/40">RestroPanel v1.0</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V10m6 9V5m6 14v-7" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{route('admin.orders.index')}}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 12H7L6 8zM9 8V6a3 3 0 116 0v2" />
                    </svg>
                    Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 13c3-6 13-6 16 0-2 1-4 1.5-8 1.5S6 14 4 13z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 13.5V17m8-3.5V17" />
                    </svg>
                    Products
                </a>
                <a href="{{ route('admin.events.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <rect x="4" y="5" width="16" height="15" rx="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 9h16M8 3v3m8-3v3" />
                    </svg>
                    Events
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="group flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.bookings.*') ? 'bg-peony text-espresso' : 'text-espresso/60 hover:bg-peony/10 hover:text-espresso' }} rounded-xl font-medium text-sm transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                    <svg class="w-5 h-5 shrink-0 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 4h12v16l-6-4-6 4V4z" />
                    </svg>
                    Bookings
                </a>
            </nav>
        </div>

        <!-- Admin Profile Info -->
        <div class="p-4 border-t border-peony/10 bg-peony/5">
            <div class="flex items-center gap-3 mb-3">
                <div class="h-10 w-10 bg-espresso text-white rounded-full flex items-center justify-center font-bold text-sm">
                    AD
                </div>
                <div>
                    <p class="text-sm font-semibold text-espresso">Admin Account</p>
                    <p class="text-xs text-espresso/40">Role: Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex w-full items-center justify-center gap-2 rounded-xl border border-peony/30 bg-white px-3 py-2 text-sm font-semibold text-espresso/70 transition-all duration-200 hover:-translate-y-0.5 hover:bg-peony/10 hover:text-espresso">
                    <svg class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H6a2 2 0 00-2 2v10a2 2 0 002 2h3m4-4l4-4m0 0l-4-4m4 4H9" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN BODY -->
    <main class="flex-1 flex flex-col overflow-y-auto">

        <!-- TOP BAR -->
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3 w-1/3">
                <svg class="w-4 h-4 text-espresso/30 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <circle cx="11" cy="11" r="7" stroke-linecap="round" stroke-linejoin="round" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.3-4.3" />
                </svg>
                <input type="text" placeholder="Search anything..." class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso" />
            </div>

            <div class="flex items-center gap-6 text-sm font-medium">
                <span class="text-espresso/40 hover:text-espresso cursor-pointer relative">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
                    </svg>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </span>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center text-espresso">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 10h11a3 3 0 013 3 3 3 0 01-3 3h-1M16 10v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6h11z" />
                        </svg>
                    </div>
                    <span class="text-espresso/80">N&amp;P Barista</span>
                </div>
            </div>
        </header>

        <!-- DASHBOARD CONTAINER -->
        <div class="p-8 space-y-8 max-w-[1600px] w-full mx-auto">

            <!-- Dashboard Title -->
            <div>
                <h1 class="text-2xl font-bold text-espresso tracking-tight">Dashboard</h1>
                <p class="text-sm text-espresso/50 mt-1">Real-time cafe stats, sales reports, and customer reservations.</p>
            </div>

            <!-- 1. HERO METRIC CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Orders -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between transition-shadow duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Total Orders</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">{{ number_format($totalOrders) }}</h3>
                        <span class="text-xs text-emerald-500 font-medium mt-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" /></svg>
                            8% from last week
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-peony/20 flex items-center justify-center text-espresso">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 8h12l-1 12H7L6 8zM9 8V6a3 3 0 116 0v2" />
                        </svg>
                    </div>
                </div>

                <!-- Revenue Today -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between transition-shadow duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Revenue Today</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">${{ number_format($revenueToday, 2) }}</h3>
                        <span class="text-xs text-emerald-500 font-medium mt-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" /></svg>
                            3.4% daily goal
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-peony/20 flex items-center justify-center text-espresso">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m4.5-13.5c0-1.7-2-3-4.5-3s-4.5 1.3-4.5 3 2 3 4.5 3 4.5 1.3 4.5 3-2 3-4.5 3-4.5-1.3-4.5-3" />
                        </svg>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between transition-shadow duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Pending Orders</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">{{ $pendingOrders }}</h3>
                        <span class="text-xs text-amber-500 font-medium mt-2 block">Needs fulfillment</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-peony/20 flex items-center justify-center text-espresso">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <circle cx="12" cy="12" r="8" stroke-linecap="round" stroke-linejoin="round" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 2" />
                        </svg>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between transition-shadow duration-200 hover:shadow-md">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Total Customers</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">{{ number_format($totalCustomers) }}</h3>
                        <span class="text-xs text-rose-400 font-medium mt-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                            1.4% change
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-peony/20 flex items-center justify-center text-espresso">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <circle cx="9" cy="9" r="3" stroke-linecap="round" stroke-linejoin="round" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 19c0-3 2.7-5 6-5s6 2 6 5M16 8a3 3 0 010 5.5M19 19c0-2.2-1.3-3.9-3.5-4.6" />
                        </svg>
                    </div>
                </div>

            </div>

            <!-- 2. MAIN CHARTS GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Revenue Overview (Monthly Bar Chart) -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-peony/10 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-espresso text-base">Revenue Overview</h3>
                        <span class="text-xs text-espresso/40">This Year</span>
                    </div>
                    <div class="h-80 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Order Types (Donut Chart) -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-espresso text-base">Order Types</h3>
                            <span class="text-xs text-espresso/40">Today</span>
                        </div>
                        <div class="h-56 w-full flex items-center justify-center relative">
                            <canvas id="orderTypesChart"></canvas>
                        </div>
                    </div>
                    <!-- Legend Indicators -->
                    <div class="space-y-2 mt-4">
                        <div class="flex justify-between items-center text-xs">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-[#E07A5F]"></span> Pay at Shop</span>
                            <span class="font-bold">{{ $orderTypesData['Pay at Shop'] }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-[#81B29A]"></span> COD</span>
                            <span class="font-bold">{{ $orderTypesData['Cash on Delivery'] }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-[#F2CC8F]"></span> Manual</span>
                            <span class="font-bold">{{ $orderTypesData['Manual Payment'] }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 3. LOWER CONTENT GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Weekly Orders Curve (Line Chart) -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-peony/10 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-espresso text-base">Orders Overview</h3>
                        <span class="text-xs text-espresso/40">Mon - Sun</span>
                    </div>
                    <div class="h-64 w-full">
                        <canvas id="ordersOverviewChart"></canvas>
                    </div>
                </div>

                <!-- Customer Growth (Bar Chart) -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-espresso text-base">New Customers</h3>
                        <span class="text-xs text-espresso/40">Weekly Growth</span>
                    </div>
                    <div class="h-64 w-full">
                        <canvas id="customerGrowthChart"></canvas>
                    </div>
                </div>

            </div>

            <!-- 4. HOT & TRENDING MENU -->
            <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm">
                <h3 class="font-bold text-espresso text-base mb-6">Hot &amp; Trending Menu</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($trendingProducts as $product)
                        <div class="bg-[#FDF8F6] p-4 rounded-xl border border-peony/10 flex flex-col items-center text-center transition-shadow duration-200 hover:shadow-sm">
                            <div class="w-24 h-24 rounded-full bg-peony/20 mb-4 flex items-center justify-center text-espresso">
                                <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 13c3-6 13-6 16 0-2 1-4 1.5-8 1.5S6 14 4 13z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 13.5V17m8-3.5V17" />
                                </svg>
                            </div>
                            <h4 class="font-semibold text-espresso text-sm line-clamp-1">{{ $product->name }}</h4>
                            <div class="flex items-center gap-0.5 mt-1 text-amber-400">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 1.5l2.6 5.4 5.9.8-4.3 4.2 1 5.9L10 15l-5.2 2.8 1-5.9L1.5 7.7l5.9-.8L10 1.5z" />
                                    </svg>
                                @endfor
                            </div>
                            <div class="mt-3 flex items-center justify-between w-full border-t border-peony/10 pt-3">
                                <span class="text-xs text-espresso/40">{{ $product->total_sold }} units sold</span>
                                <span class="font-bold text-espresso text-sm">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-4 text-center py-8 text-espresso/40 text-sm">
                            No trending products captured yet. Place some orders to see sales metrics!
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // 1. REVENUE OVERVIEW (Monthly Bar Chart)
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Income ($)',
                    data: @json($monthlyRevenueData),
                    backgroundColor: '#E07A5F',
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { border: { dash: [5, 5] } }
                }
            }
        });

        // 2. ORDER TYPES (Donut Chart)
        const ctxTypes = document.getElementById('orderTypesChart').getContext('2d');
        new Chart(ctxTypes, {
            type: 'doughnut',
            data: {
                labels: ['Pay at Shop', 'Cash on Delivery', 'Manual Payment'],
                datasets: [{
                    data: [
                        {{ $orderTypesData['Pay at Shop'] }},
                        {{ $orderTypesData['Cash on Delivery'] }},
                        {{ $orderTypesData['Manual Payment'] }}
                    ],
                    backgroundColor: ['#E07A5F', '#81B29A', '#F2CC8F'],
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                cutout: '70%'
            }
        });

        // 3. ORDERS OVERVIEW (Weekly Line Chart)
        const ctxOrders = document.getElementById('ordersOverviewChart').getContext('2d');
        new Chart(ctxOrders, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Orders',
                    data: @json($weeklyOrdersData),
                    borderColor: '#E07A5F',
                    backgroundColor: 'rgba(224, 122, 95, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#E07A5F',
                    pointBorderColor: '#ffffff',
                    pointHoverRadius: 6,
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { border: { dash: [5, 5] } }
                }
            }
        });

        // 4. CUSTOMER GROWTH (Bar Chart)
        const ctxGrowth = document.getElementById('customerGrowthChart').getContext('2d');
        new Chart(ctxGrowth, {
            type: 'bar',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    data: @json($customerSignupsData),
                    backgroundColor: '#81B29A',
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false } },
                    y: { display: false }
                }
            }
        });
    });
</script>
@endsection