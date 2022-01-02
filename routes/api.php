<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user',[UserController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //Product routes
    Route::get('/products', [ProductController::class, 'index']);
});