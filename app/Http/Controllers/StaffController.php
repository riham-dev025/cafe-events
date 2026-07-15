<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Product;

class StaffController extends Controller
{
    //
     public function dashboard()
    {
        return view('staff.dashboard');
    }

    public function orders()
    {
        $orders = Order::latest()->get();

        return view('staff.orders', compact('orders'));
    }

public function bookings()
{
    $bookings = Booking::with(['user', 'service'])
        ->latest()
        ->get();

    foreach ($bookings as $booking) {
        $booking->bookedSeats = Booking::where('service_id', $booking->service_id)
            ->where('booking_start', $booking->booking_start)
            ->sum('seats_reserved');
    }

    return view('staff.bookings', compact('bookings'));
}

    public function inventory()
    {
        $products = Product::all();

        return view('staff.inventory', compact('products'));
    }
}
