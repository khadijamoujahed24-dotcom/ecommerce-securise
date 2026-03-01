<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protégé)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Paiement commande
Route::post('/payment/{id}', [OrderController::class, 'pay'])
    ->middleware(['auth'])
    ->name('payment.pay');

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