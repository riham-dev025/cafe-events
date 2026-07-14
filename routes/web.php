<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


// 1. PUBLIC ROUTES (Guests can view these)

Route::get('/', function () {
    $featuredProducts = collect([
        (object) ['name' => 'Espresso tonic', 'price' => 5.50],
        (object) ['name' => 'Peony rose brownie', 'price' => 6.00],
        (object) ['name' => 'Gift card', 'price' => 25.00],
    ]);

    $featuredServices = collect([
        (object) ['name' => 'Painting night', 'capacity' => 12],
        (object) ['name' => 'Live music', 'capacity' => 30],
        (object) ['name' => 'Romantic date', 'capacity' => 2],
    ]);

    return view('welcome', compact('featuredProducts', 'featuredServices'));
});

// Shop & Cart catalog routes
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::post('/products/{id}/cart', [ProductsController::class, 'addToCart'])->name('products.cart');
Route::get('/cart', [ProductsController::class, 'viewCart'])->name('cart.index');
Route::post('/checkout', [ProductsController::class, 'checkout'])->name('products.checkout');



// 2. AUTHENTICATED ROUTES (Log-in required)

Route::middleware(['auth', 'verified'])->group(function () {
    
    // User Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Profile settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CUSTOMER BOOKINGS 
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

    
    // 3. ADMIN-ONLY ROUTES (Admin middleware)
   
   Route::middleware('role:admin')->group(function () {
        
        // This is the brain route that gathers everything for your custom dashboard view!
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        // Product Catalog Management (View, Add, Edit, Delete)
        Route::get('/admin/products', [ProductsController::class, 'adminIndex'])->name('admin.products.index');
        Route::post('/admin/products', [ProductsController::class, 'store'])->name('admin.products.store');
        Route::put('/admin/products/{id}', [ProductsController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{id}', [ProductsController::class, 'destroy'])->name('admin.products.destroy');

        // Toggle availability status & update stock
        Route::patch('/admin/products/{id}/toggle', [ProductsController::class, 'toggleStatus'])->name('admin.products.toggle');
        Route::patch('/admin/products/{id}/update-stock', [ProductsController::class, 'updateStock'])->name('admin.products.updateStock');

        
    });

});

require __DIR__.'/auth.php';