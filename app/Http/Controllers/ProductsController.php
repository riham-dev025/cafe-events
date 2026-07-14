<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index(){
        $products = Product::where('status', 'available')->get();
        return view('products.index',compact('products'));
    }

    public function addToCart(Request $request,$id){
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // If product already in cart, increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Add new product
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', "{$product->name} added to cart!");
    }

    public function checkout(Request $request){
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->back()->withErrors(['error' => 'Your cart is empty!']);
        }

        $totalAmount = 0;
        foreach ($cart as $id => $details) {
            $totalAmount += $details['price'] * $details['quantity'];
        }

        // 1. Create the base Order record
        $order = Order::create([
            'user_id' => auth()->id() ?? 3, // fallback to Jane for testing
            'order_status' => 'Pending',
            'total_amount' => $totalAmount,
            'payment_method' => $request->input('payment_method', 'Cash at Counter'),
            'payment_status' => 'Unpaid',
        ]);

        // 2. Create the individual Order Items & decrease stock
        foreach ($cart as $productId => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $details['quantity'],
                'unit_price' => $details['price'],
            ]);

            // Deduct from stock
            $product = Product::find($productId);
            if ($product) {
                $product->decrement('stock', $details['quantity']);
            }
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('shop.index')->with('success', 'Order placed successfully! Please pay at the counter when you arrive.');

    }
    public function viewCart(){
        $cart = session()->get('cart',[]);
        return view('products.cart',compact('cart'));
    }
}
