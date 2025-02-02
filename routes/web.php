<?php

use App\Http\Middleware\IsSeller;
use App\Http\Middleware\IsCustomer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Seller\DashboardSellerController;
use App\Http\Controllers\Customer\DashboardCustomerController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('register', [RegisterController::class, 'showForm'])->name('showRegisterForm');
Route::get('login', [LoginController::class, 'showForm'])->name('showLoginForm');

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [AuthController::class, 'settings'])->name('auth.settings');
    Route::post('/settings', [AuthController::class, 'updateSettings'])->name('update.settings');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/menu', [MenuController::class, 'index'])->name('allmenu');
Route::get('/keranjang/tambah/{productId}', [MenuController::class, 'addToCart'])->name('keranjang.add');

Route::prefix('seller')->name('seller.')->middleware(IsSeller::class)->group(function () {
    Route::get('/', [DashboardSellerController::class, 'index'])->name('dashboard');

    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [SellerOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/update-status', [SellerOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/products', [SellerProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [SellerProductController::class, 'create'])->name('products.create');
    Route::post('/products', [SellerProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [SellerProductController::class, 'edit'])->name('products.edit');
    Route::put('/products', [SellerProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [SellerProductController::class, 'destroy'])->name('products.destroy');
});

Route::prefix('customer')->name('customer.')->middleware(IsCustomer::class)->group(function () {
    Route::get('/', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/order', [CartController::class, 'order'])->name('cart.order');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/customer/{id}/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/cancel', [CustomerOrderController::class, 'cancel'])->name('orders.cancel');
});