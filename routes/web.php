<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminStaffController;



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
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password');

    // CUSTOMER BOOKINGS 
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])
    ->middleware('auth')
    ->name('bookings.show');
    Route::middleware('auth')->group(function(){

    Route::get('/bookings/{booking}/edit',
        [BookingController::class,'edit'])
        ->name('bookings.edit');


    Route::patch('/bookings/{booking}',
        [BookingController::class,'update'])
        ->name('bookings.update');


    Route::patch('/bookings/{booking}/cancel',
        [BookingController::class,'cancel'])
        ->name('bookings.cancel');

});
Route::middleware('auth')->group(function(){

    Route::get('/orders/{order}',
        [OrderController::class,'show'])
        ->name('orders.show');

});

    
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
        
        // FIX: Renamed URIs and Route Names so they don't collide
        Route::get('/admin/orders/pending', [AdminController::class, 'pendingOrders'])->name('admin.orders.pending');
        
        Route::get('/admin/bookings', [AdminController::class, 'allBookings'])->name('admin.bookings.index');
        Route::patch('/admin/bookings/{id}/cancel', [AdminController::class, 'cancelBooking'])->name('admin.bookings.cancel');

        Route::get('/admin/events', [AdminController::class, 'eventsIndex'])->name('admin.events.index');
        Route::get('/admin/events/create', [AdminController::class, 'eventsCreate'])->name('admin.events.create');
        Route::post('/admin/events', [AdminController::class, 'eventsStore'])->name('admin.events.store');
        Route::get('/admin/events/{id}/edit', [AdminController::class, 'eventsEdit'])->name('admin.events.edit');
        Route::put('/admin/events/{id}', [AdminController::class, 'eventsUpdate'])->name('admin.events.update');
        Route::delete('/admin/events/{id}', [AdminController::class, 'eventsDestroy'])->name('admin.events.destroy');
        
        Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');

        // STAFF MANAGEMENT ROUTES
        Route::get('/admin/staff', [AdminStaffController::class, 'index'])->name('admin.staff.index');
        Route::post('/admin/staff', [AdminStaffController::class, 'store'])->name('admin.staff.store');
        Route::delete('/admin/staff/{id}', [AdminStaffController::class, 'destroy'])->name('admin.staff.destroy');
    });

});

Route::middleware(['auth','role:admin'])
->prefix('admin')
->group(function(){

    // dashboard
    Route::get('/', 
    [AdminController::class,'index'])
    ->name('admin.dashboard');


    // orders list
    Route::get('/orders',
    [AdminController::class,'allOrders'])
    ->name('admin.orders.index');


    // order details
    Route::get('/orders/{order}',
    [AdminController::class,'show'])
    ->name('admin.orders.show');


    // change order status
    Route::patch('/orders/{order}/status',
    [AdminController::class,'updateStatus'])
    ->name('admin.orders.status');


    // mark payment
    Route::patch('/orders/{order}/payment',
    [AdminController::class,'updatePayment'])
    ->name('admin.orders.payment');

});

//staff
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff', [StaffController::class, 'dashboard'])
        ->name('staff.dashboard');

    Route::get('/staff/orders', [StaffController::class, 'orders'])
        ->name('staff.orders');

    Route::get('/staff/bookings', [StaffController::class, 'bookings'])
        ->name('staff.bookings');

    Route::get('/staff/inventory', [StaffController::class, 'inventory'])
        ->name('staff.inventory');

});

require __DIR__.'/auth.php';