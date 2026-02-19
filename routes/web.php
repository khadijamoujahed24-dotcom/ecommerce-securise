<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
     Route::post('/confirm-order', [OrderController::class, 'confirm'])
        ->name('order.confirm');

  Route::get('/admin', function () {

    if(!Auth::check() || Auth::user()?->role !== 'admin') {
    abort(403);
}
    return view('admin.dashboard');
});
});

require __DIR__.'/auth.php';


Route::resource('products', ProductController::class);


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');

Route::get('/remove-from-cart/{product}', 
    [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/payment/{id}', [OrderController::class, 'paymentForm'])
    ->name('payment.show');

Route::post('/payment/{id}', [OrderController::class, 'pay'])
    ->name('payment.pay');


