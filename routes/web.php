<?php


use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Accueil

// Page d'accueil

Route::get('/', function () {
    return view('welcome'); // resources/views/welcome.blade.php
});



// Dashboard utilisateur
Route::get('/dashboard', function () {
    return view('dashboard'); // resources/views/dashboard.blade.php
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes nécessitant authentification
Route::middleware('auth')->group(function () {
    
    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Checkout / Confirmer commande
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/confirm-order', [OrderController::class, 'confirm'])->name('order.confirm');

    // Paiement
    Route::get('/payment/{id}', [OrderController::class, 'paymentForm'])->name('payment.show');
    Route::post('/payment/{id}', [OrderController::class, 'pay'])->name('payment.pay');

    // Dashboard admin
    Route::get('/admin', function () {
        if(!Auth::check() || Auth::user()?->role !== 'admin') {
            abort(403);
        }
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    })->name('admin.dashboard');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Catalogue et produits
Route::get('/catalogue', [ProductController::class, 'index'])->name('products.catalogue'); // resources/views/products/index.blade.php
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');    // resources/views/products/show.blade.php


// Panier
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');                   // resources/views/cart/index.blade.php

Route::resource('products', ProductController::class);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index'); 

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/remove-from-cart/{product}', [CartController::class, 'remove'])->name('cart.remove');


// Resource complète pour produits (CRUD si nécessaire)
Route::resource('products', ProductController::class);

Route::get('/remove-from-cart/{product}', 
    [CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/payment/{id}', [OrderController::class, 'paymentForm'])
    ->name('payment.show');

// Dashboard (protégé)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Paiement commande
Route::post('/payment/{id}', [OrderController::class, 'pay'])
    ->middleware(['auth'])
    ->name('payment.pay');


Route::resource('products', ProductController::class);



/*
|--------------------------------------------------------------------------
| SECURITY XSS DEMO ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/security/xss', function (Request $request) {
    return view('security.xss');
})->middleware('auth');

// Auth routes (Breeze / Laravel auth)
require __DIR__.'/auth.php';


