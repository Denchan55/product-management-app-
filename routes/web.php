<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/detail/{productId}', [ProductController::class, 'detail']);

Route::get('/products/register', [ProductController::class, 'showRegister']);
Route::post('/products/register', [ProductController::class, 'register']);

Route::get('/products/{productId}/update', [ProductController::class, 'showUpdate']);
Route::post('/products/{productId}/update', [ProductController::class, 'update']);

Route::get('/products/search', [ProductController::class, 'search']);

Route::post('/products/{productId}/delete', [ProductController::class, 'delete']);
