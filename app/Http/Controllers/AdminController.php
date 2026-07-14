<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;
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
}