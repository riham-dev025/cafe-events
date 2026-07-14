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
                <div class="h-10 w-10 bg-peony/20 rounded-xl flex items-center justify-center text-espresso font-bold text-lg">
                    🌸
                </div>
                <div>
                    <h2 class="font-bold text-espresso text-base tracking-tight">Nook & Peony</h2>
                    <span class="text-xs text-espresso/40">RestroPanel v1.0</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-peony text-espresso rounded-xl font-medium text-sm transition">
                    <span class="text-lg">📊</span> Dashboard
                </a>
                <a href="{{route('admin.orders.index')}}" class="flex items-center gap-3 px-4 py-3 text-espresso/60 hover:bg-peony/10 hover:text-espresso rounded-xl font-medium text-sm transition">
                    <span class="text-lg">🛍️</span> Orders
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 text-espresso/60 hover:bg-peony/10 hover:text-espresso rounded-xl font-medium text-sm transition">
                    <span class="text-lg">🍰</span> Products
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-espresso/60 hover:bg-peony/10 hover:text-espresso rounded-xl font-medium text-sm transition">
                    <span class="text-lg">📅</span> Bookings
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-espresso/60 hover:bg-peony/10 hover:text-espresso rounded-xl font-medium text-sm transition">
                    <span class="text-lg">📦</span> Inventory
                </a>
            </nav>
        </div>

        <!-- Admin Profile Info -->
        <div class="p-4 border-t border-peony/10 bg-peony/5">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 bg-espresso text-white rounded-full flex items-center justify-center font-bold text-sm">
                    AD
                </div>
                <div>
                    <p class="text-sm font-semibold text-espresso">Admin Account</p>
                    <p class="text-xs text-espresso/40">Role: Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN BODY -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <!-- TOP BAR -->
        <header class="h-16 bg-white border-b border-peony/20 px-8 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-4 w-1/3">
                <span class="text-espresso/40 text-lg">🔍</span>
                <input type="text" placeholder="Search anything..." class="w-full text-sm outline-none bg-transparent placeholder-espresso/30 text-espresso" />
            </div>
            
            <div class="flex items-center gap-6 text-sm font-medium">
                <span class="text-espresso/40 hover:text-espresso cursor-pointer relative">
                    🔔 <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </span>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-peony/30 flex items-center justify-center">☕</div>
                    <span class="text-espresso/80">N&P Barista</span>
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
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Total Orders</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">{{ number_format($totalOrders) }}</h3>
                        <span class="text-xs text-emerald-500 font-medium mt-2 block">↑ 8% from last week</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-peony/20 flex items-center justify-center text-xl">🛒</div>
                </div>

                <!-- Revenue Today -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Revenue Today</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">${{ number_format($revenueToday, 2) }}</h3>
                        <span class="text-xs text-emerald-500 font-medium mt-2 block">↑ 3.4% daily goal</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-xl">💰</div>
                </div>

                <!-- Pending Orders -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Pending Orders</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">{{ $pendingOrders }}</h3>
                        <span class="text-xs text-amber-500 font-medium mt-2 block">Needs fulfillment</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">⏳</div>
                </div>

                <!-- Total Customers -->
                <div class="bg-white p-6 rounded-2xl border border-peony/10 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-espresso/40 uppercase tracking-wider">Total Customers</p>
                        <h3 class="text-3xl font-extrabold text-espresso mt-1">{{ number_format($totalCustomers) }}</h3>
                        <span class="text-xs text-rose-400 font-medium mt-2 block">↓ 1.4% change</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-rose-100 flex items-center justify-center text-xl">👥</div>
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
                <h3 class="font-bold text-espresso text-base mb-6">Hot & Trending Menu</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse($trendingProducts as $product)
                        <div class="bg-[#FDF8F6] p-4 rounded-xl border border-peony/10 flex flex-col items-center text-center">
                            <div class="w-24 h-24 rounded-full bg-peony/20 mb-4 flex items-center justify-center text-3xl">
                                🍳
                            </div>
                            <h4 class="font-semibold text-espresso text-sm line-clamp-1">{{ $product->name }}</h4>
                            <div class="flex items-center gap-1 mt-1 text-xs text-amber-500">
                                ⭐️⭐️⭐️⭐️⭐️
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