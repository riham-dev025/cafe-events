<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    //
    public function show(Order $order)
    {

        // Security check
        if($order->user_id !== auth()->id()){
            abort(403);
        }


        $order->load([
            'items.product'
        ]);


        return view('orders.show', compact('order'));

    }
}
