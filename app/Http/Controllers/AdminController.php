<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    
    public function index()
    {
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // ==========================================
        // 1. HERO METRIC CARDS (Top of Dashboard)
        // ==========================================
        
        $totalOrdersCount = Order::count();
        
        $revenueToday = Order::where('order_status', 'Completed')
            ->whereDate('updated_at', $today)
            ->sum('total_amount');
            
        $pendingOrdersCount = Order::where('order_status', 'Pending')->count();
        
        // Count users who aren't admins (assuming role is stored on user or role relationship)
        $totalCustomersCount = User::whereHas('role', function($query) {
            $query->where('name', 'customer');
        })->count();


        // ==========================================
        // 2. REVENUE OVERVIEW CHART (Monthly Breakdown)
        // ==========================================
        
        // Groups completed sales by month for the current year
        $monthlyRevenueRaw = Order::select(
                DB::raw("EXTRACT(MONTH FROM created_at) as month"), 
                DB::raw("SUM(total_amount) as total")
            )
            ->where('order_status', 'Completed')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Format for Charting: Ensure all 12 months exist (even with 0 sales)
        $monthlyRevenueData = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyRevenueData[] = $monthlyRevenueRaw[$m] ?? 0;
        }


        // ==========================================
        // 3. ORDERS OVERVIEW CHART (Weekly Line Chart)
        // ==========================================
        
        // Count orders placed each day of the current week
        $weeklyOrdersRaw = Order::select(
                DB::raw("TO_CHAR(created_at, 'Dy') as day_name"), // e.g. Mon, Tue
                DB::raw("COUNT(id) as count"),
                DB::raw("EXTRACT(ISODOW FROM created_at) as day_num")
            )
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day_name', 'day_num')
            ->orderBy('day_num')
            ->pluck('count', 'day_name')
            ->toArray();

        // Format for Charting: Match order to Mon-Sun sequence
        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $weeklyOrdersData = [];
        foreach ($daysOfWeek as $day) {
            $weeklyOrdersData[] = $weeklyOrdersRaw[$day] ?? 0;
        }


        // ==========================================
        // 4. ORDER TYPES (Distribution by Payment Method)
        // ==========================================
        
        $orderTypesRaw = Order::select('payment_method', DB::raw('count(id) as total'))
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method')
            ->toArray();

        // Standardize keys so your frontend knows exactly what to render
        $orderTypesData = [
            'Pay at Shop' => $orderTypesRaw['Pay at Shop'] ?? 0,
            'Cash on Delivery' => $orderTypesRaw['Cash on Delivery'] ?? 0,
            'Manual Payment' => $orderTypesRaw['Manual Payment'] ?? 0,
        ];


        // ==========================================
        // 5. CUSTOMER GROWTH CHART (Last 7 Days Bar Chart)
        // ==========================================
        
        $customerSignupsRaw = User::select(
                DB::raw("TO_CHAR(created_at, 'Dy') as day_name"),
                DB::raw("COUNT(id) as count"),
                DB::raw("EXTRACT(ISODOW FROM created_at) as day_num")
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('day_name', 'day_num')
            ->orderBy('day_num')
            ->pluck('count', 'day_name')
            ->toArray();

        $customerSignupsData = [];
        foreach ($daysOfWeek as $day) {
            $customerSignupsData[] = $customerSignupsRaw[$day] ?? 0;
        }


        // ==========================================
        // 6. HOT & TRENDING MENU (Top Selling Products)
        // ==========================================
        
        // Join OrderItems and Products to find the most popular items by volume
        $trendingProducts = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->take(4) // Fetch Top 4 items
            ->get();


        // ==========================================
        // 7. DATA PACKAGING
        // ==========================================
        
        return view('admin.dashboard', [
            // Hero Metrics
            'totalOrders' => $totalOrdersCount,
            'revenueToday' => $revenueToday,
            'pendingOrders' => $pendingOrdersCount,
            'totalCustomers' => $totalCustomersCount,

            // Chart Datasets (PHP arrays ready for JSON encoding in Blade!)
            'monthlyRevenueData' => $monthlyRevenueData,
            'weeklyOrdersData' => $weeklyOrdersData,
            'orderTypesData' => $orderTypesData,
            'customerSignupsData' => $customerSignupsData,
            
            // Item Listings
            'trendingProducts' => $trendingProducts,
        ]);
    }
    public function pendingOrders()
{
    // Fetch only Pending orders, sorted by oldest first
    $pendingOrders = Order::with(['user', 'items.product'])
        ->where('order_status', 'Pending')
        ->orderBy('created_at', 'asc')
        ->paginate(15);

    return view('admin.orders.index', compact('pendingOrders'));
}

public function allOrders(Request $request)
{
    $status = $request->get('status', 'All');
    $search = $request->get('search');

    // Build the query
    $ordersQuery = Order::with(['user', 'items.product'])->latest();

    // Apply filters
    if ($status !== 'All') {
        $ordersQuery->where('order_status', $status);
    }

    if ($search) {
        $ordersQuery->where(function($q) use ($search) {
            $q->where('id', 'LIKE', "%{$search}%")
              ->orWhereHas('user', function($userQuery) use ($search) {
                  $userQuery->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
              });
        });
    }

    $orders = $ordersQuery->paginate(15)->withQueryString();

    // Quick counts for the header badges
    $counts = [
        'All' => Order::count(),
        'Pending' => Order::where('order_status', 'Pending')->count(),
        'Preparing' => Order::where('order_status', 'Preparing')->count(),
        'Completed' => Order::where('order_status', 'Completed')->count(),
    ];

    return view('admin.orders.index', compact('orders', 'status', 'counts'));
}

public function allBookings(Request $request)
{
    $status = $request->get('status', 'All');
    $search = $request->get('search');

    // Build query with relationships
    $bookingsQuery = Booking::with(['user', 'service', 'resource', 'staff'])->latest();

    if ($status !== 'All') {
        $bookingsQuery->where('booking_status', $status);
    }

    if ($search) {
        $bookingsQuery->where(function($q) use ($search) {
            $q->where('id', 'LIKE', "%{$search}%")
              ->orWhereHas('user', function($userQuery) use ($search) {
                  $userQuery->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
              });
        });
    }

    $bookings = $bookingsQuery->paginate(15)->withQueryString();

    $counts = [
        'All' => Booking::count(),
        'Pending' => Booking::where('booking_status', 'Pending')->count(),
        'Confirmed' => Booking::where('booking_status', 'Confirmed')->count(),
        'Cancelled' => Booking::where('booking_status', 'Cancelled')->count(),
    ];

    return view('admin.bookings.index', compact('bookings', 'status', 'counts'));
}

public function cancelBooking($id)
{
    $booking = Booking::findOrFail($id);
    $booking->update(['booking_status' => 'Cancelled']);

    return redirect()->back()->with('success', 'Booking status set to Cancelled.');
}

// ==========================================
// B. EVENTS (SERVICES) CRUD METHODS
// ==========================================

public function eventsIndex()
{
    $events = Service::latest()->paginate(10);
    return view('admin.events.index', compact('events'));
}

public function eventsCreate()
{
    return view('admin.events.create');
}

public function eventsStore(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'capacity' => 'required|integer|min:1',
    ]);

    Service::create($validated);

    return redirect()->route('admin.events.index')->with('success', 'Event successfully created!');
}

public function eventsEdit($id)
{
    $event = Service::findOrFail($id);
    return view('admin.events.edit', compact('event'));
}

public function eventsUpdate(Request $request, $id)
{
    $event = Service::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'capacity' => 'required|integer|min:1',
    ]);

    $event->update($validated);

    return redirect()->route('admin.events.index')->with('success', 'Event successfully updated!');
}

public function eventsDestroy($id)
{
    $event = Service::findOrFail($id);
    $event->delete();

    return redirect()->route('admin.events.index')->with('success', 'Event successfully deleted.');
}
}