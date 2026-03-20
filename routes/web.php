<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);

use App\Http\Controllers\CartController;

Route::post('/cart/add', [CartController::class, 'add']);
Route::post('/cart/update', [CartController::class, 'update']);
Route::post('/cart/remove', [CartController::class, 'remove']);
Route::get('/cart', [CartController::class, 'view']);
Route::get('/cart/count', [CartController::class, 'itemCount']);

use App\Http\Controllers\CheckoutController;
Route::post('/checkout', [CheckoutController::class, 'checkout']);

use App\Http\Controllers\OrderController;
Route::get('/my-orders', [OrderController::class, 'myOrders']);

//admin routes
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

Route::get('/admin/orders', [AdminOrderController::class, 'index']);
Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show']);

