<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a product catalogue
     */
    public function index()
    {
        // Only show products that are available and actually in stock
        $products = Product::where('status', 'available')
                           ->where('stock', '>', 0)
                           ->get();
                           
        return view('products.index', compact('products'));
    }

    /**
     * Add an item to the session cart
     */
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        // Calculate total requested quantity if already in cart
        $currentQtyInCart = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $newQty = $currentQtyInCart + 1;

        // Prevent adding more than what's available in stock
        if ($newQty > $product->stock) {
            return redirect()->back()->withErrors(['error' => "Sorry, only {$product->stock} units of {$product->name} are available."]);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', "{$product->name} added to cart!");
    }

    /**
     * View the current cart
     */
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('products.cart', compact('cart'));
    }

    /**
     * Process checkout and create a product order
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->back()->withErrors(['error' => 'Your cart is empty!']);
        }

        // Validate the simulated payment method input
        $request->validate([
            'payment_method' => 'required|in:Pay at Shop,Cash on Delivery,Manual Payment',
        ]);

        // Wrap in a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            $totalAmount = 0;

            // First Pass: Double-check stock for all items before writing anything to DB
            foreach ($cart as $productId => $details) {
                $product = Product::findOrFail($productId);
                
                if ($product->stock < $details['quantity']) {
                    return redirect()->route('products.viewCart')->withErrors([
                        'error' => "Could not complete order. {$product->name} only has {$product->stock} items remaining in stock."
                    ]);
                }
                
                $totalAmount += $details['price'] * $details['quantity'];
            }

            // 1. Create the base Order record
            $order = Order::create([
                'user_id' => auth()->id() ?? 3, // Fallback testing ID (e.g., Jane) if no logged-in user
                'order_status' => 'Pending',     // Meets requirement: Pending, Confirmed, Completed, Cancelled
                'total_amount' => $totalAmount,
                'payment_method' => $request->input('payment_method'),
                'payment_status' => 'Unpaid',    // Meets requirement: Unpaid or Paid
            ]);

            // 2. Create the individual Order Items & decrease stock
            foreach ($cart as $productId => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // Deduct from stock
                $product = Product::findOrFail($productId);
                $product->decrement('stock', $details['quantity']);
            }

            // Commit changes to DB
            DB::commit();

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('products.index')->with('success', "Order #{$order->id} placed successfully! Method: {$order->payment_method}.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Something went wrong during checkout. Please try again. Error: ' . $e->getMessage()]);
        }
    }
}