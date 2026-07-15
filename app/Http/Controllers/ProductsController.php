<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a product catalogue
     */
    public function index(Request $request)
    {
        // Only show products that are available and actually in stock
       $query = Product::with('category');

        // 2. Filter by Availability
        if ($request->filled('availability')) {
            if ($request->availability === 'available') {
                $query->where('status', 'available')->where('stock', '>', 0);
            } elseif ($request->availability === 'out_of_stock') {
                $query->where(function($q) {
                    $q->where('status', 'unavailable')
                      ->orWhere('stock', '<=', 0);
                });
            }
        } else {
            // Default behavior: Only show available & in-stock items unless explicitly filtered
            $query->where('status', 'available')->where('stock', '>', 0);
        }

        // 3. Filter by Search Name/Description
       if ($request->filled('search')) {
            // Removed the first '%' so it searches for terms starting with your input
            $searchTerm = trim(strtolower($request->search)) . '%';
            
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', [$searchTerm])
                  ->orWhereRaw('LOWER(description) LIKE ?', [$searchTerm]);
            });
        }

        // 4. Filter by Category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 5. Filter by Price Range
        if ($request->filled('price_range')) {
            [$min, $max] = explode('-', $request->price_range);
            if ($max === 'plus') {
                $query->where('price', '>=', (float)$min);
            } else {
                $query->whereBetween('price', [(float)$min, (float)$max]);
            }
        }

        $products = $query->latest()->get();
        $categories = ProductCategory::all();

        // If it's an AJAX request, return only the grid partial
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'html' => view('products.partials.grid-items', compact('products'))->render()
            ]);
        }

        return view('products.index', compact('products', 'categories'));
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
            $errorMessage = "Sorry, only {$product->stock} units of {$product->name} are available.";
            
            // Check if it's an AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 422); // 422 is the standard code for validation/input errors
            }

            return redirect()->back()->withErrors(['error' => $errorMessage]);
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

        // Calculate total count of items in the cart to send back to our JS badge
        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Check if it's an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} added to cart!",
                'cart_count' => $cartCount
            ]);
        }

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
                'order_status' => 'pending',     // Meets requirement: Pending, Confirmed, Completed, Cancelled
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
                     'unit_price' => $details['price'],
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

    //admin
    public function adminIndex()
    {
       $products = Product::with('category')
        ->latest()
        ->paginate(15);


    $categories = ProductCategory::all();


    return view('admin.products.index', compact(
        'products',
        'categories'
    ));
    }

    /**
     * 2. Store a brand new product
     */
    public function store(Request $request)
    {
      
    $request->validate([

        'category_id' => 'required|exists:product_categories,id',

        'name' => 'required|string|max:255',

        'price' => 'required|numeric|min:0',

        'stock' => 'required|integer|min:0',

        'description' => 'nullable|string',

    ]);



    Product::create([

        'category_id' => $request->category_id,

        'name' => $request->name,

        'price' => $request->price,

        'stock' => $request->stock,

        'description' => $request->description,

        'status' => 'available',

    ]);



    return redirect()
        ->back()
        ->with('success','Product added successfully!');
    }

    /**
     * 3. Update an existing product (Edit)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', "{$product->name} updated successfully!");
    }

    /**
     * 4. Remove a product (Delete)
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        $product->delete();

        return redirect()->back()->with('success', "{$name} has been deleted successfully.");
    }
    public function removeFromCart(Request $request, $id)
    {
        // 1. Retrieve the current cart from session
        $cart = session()->get('cart', []);

        // 2. Check if the product exists in the cart and remove it
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // 3. Recalculate totals
        $totalItems = 0;
        $subtotal = 0.00;

        foreach ($cart as $item) {
            $totalItems += $item['quantity'] ?? 1;
            // Ensure numeric values for price and quantity calculations
            $price = floatval($item['price'] ?? 0);
            $qty = intval($item['quantity'] ?? 1);
            $subtotal += ($price * $qty);
        }

        // 4. Handle AJAX Response
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart!',
                'cart_empty' => empty($cart),
                'removed_id' => $id,
                'subtotal' => number_format($subtotal, 2),
                'total_items' => $totalItems
            ]);
        }

        // Standard browser redirect fallback
        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }
}