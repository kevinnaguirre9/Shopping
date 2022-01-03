<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'admin'])->group(function () {
    //Orders routes
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderID}', [OrdersController::class, 'show'])->name('orders.show');
    Route::put('/orders/{orderID}', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{orderID}', [OrdersController::class, 'destroy'])->name('orders.destroy');

    //Products routes
    Route::resource('/products', ProductsController::class);
});

Auth::routes([
    /*'register' => false*/
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
