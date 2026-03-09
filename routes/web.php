<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

// Routes publiques pour le catalogue et les produits côté client
Route::get('/catalogue', [ProductController::class, 'catalog'])->name('products.catalogue');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

// Routes nécessitant authentification
Route::middleware(['auth'])->group(function () {

    // Dashboard utilisateur
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Panier
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout / Confirmer commande
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/confirm-order', [OrderController::class, 'confirm'])->name('order.confirm');

    // Paiement
    Route::get('/payment/{id}', [OrderController::class, 'paymentForm'])->name('payment.show');
    Route::post('/payment/{id}', [OrderController::class, 'pay'])->name('payment.pay');

    // Routes admin protégées
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard admin
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // CRUD produits pour admin
        Route::resource('products', ProductController::class)->except(['show']);
    });
});

// Catégories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Sécurité XSS Demo
Route::get('/security/xss', function (Request $request) {
    return view('security.xss');
})->middleware('auth');