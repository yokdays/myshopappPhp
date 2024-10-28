<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', [test::class, 'index']);

Route::resource('companies', CompanyCRUDController::class);
Route::resource('shops', ShopController::class);
Route::resource('orders', OrderController::class);

// route order
Route::resource('orders', OrderController::class);
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders/{item}', [OrderController::class, 'store'])->name('orders.store');
Route::post('/order-details/increase/{id}', [OrderController::class, 'increaseQuantity'])->name('order-details.increase');
Route::post('/order-details/decrease/{id}', [OrderController::class, 'decreaseQuantity'])->name('order-details.decrease');
Route::get('/completedOrders', [OrderController::class, 'completed'])->name('orders.completed');

Route::post('/orders/{order}/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::post('/orders/{order}/processCheckout', [OrderController::class, 'processCheckout'])->name('orders.processCheckout');

Route::resource('products', ProductController::class);
    Route::get('/allOrders', [OrderController::class, 'show'])->name('products.order');
Route::group(['middleware' => ['auth', 'admin']], function () {

});

