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
    Route::get('/orders/search', [OrdersController::class, 'search'])->name('orders.search');
    Route::resource('/orders', OrdersController::class)->except('edit');
    
});

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
