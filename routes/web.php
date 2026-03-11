<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $categories = Category::all();
    $featuredProducts = Product::take(4)->get();

    return view('home', compact('categories', 'featuredProducts'));

})->name('home');

require __DIR__.'/auth.php';


/* =========================
   ROUTES PUBLIQUES
========================= */

Route::get('/catalogue', [ProductController::class, 'catalog'])->name('products.catalogue');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


/* =========================
   ROUTES AUTHENTIFIÉES
========================= */

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /* PANIER */

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');


    /* CHECKOUT */

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/confirm', [OrderController::class, 'confirm'])->name('order.confirm');


    /* PAIEMENT */

    Route::get('/payment/{order}', [OrderController::class, 'paymentForm'])->name('payment.show');
    Route::post('/payment/{order}', [OrderController::class, 'pay'])->name('payment.pay');
    Route::post('/payment/{order}/confirm', [OrderController::class, 'confirmPayment'])->name('payment.confirm');


    /* ADMIN */

    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('products', ProductController::class)->except(['show']);
    });

});


/* =========================
   DEMO SÉCURITÉ
========================= */

Route::get('/security/xss', function (Request $request) {
    return view('security.xss');
})->middleware('auth');