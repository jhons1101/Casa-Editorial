<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'search']);;
Route::get('productos/search', [ProductController::class, 'search']);
Route::get('productos/clear', [ProductController::class, 'clear']);
Route::resource('productos', ProductController::class);