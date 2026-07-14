<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProductsController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});
Route::post('/products/{id}/cart', 
    [ProductsController::class, 'addToCart']
)->name('products.cart');

Route::get('/products',
    [ProductsController::class, 'index']
)->name('products.index');
Route::get('/cart', [ProductsController::class, 'viewCart'])->name('cart.index');


require __DIR__.'/auth.php';
