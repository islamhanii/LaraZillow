<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\IndexController::class, 'index'])->name('index');
Route::get('/show', [Controllers\IndexController::class, 'show'])->name('show');

Route::get('/login', [Controllers\AuthController::class, 'create'])->name('login');
Route::post('/login', [Controllers\AuthController::class, 'store'])->name('login.store');

Route::resource('listing', Controllers\ListingController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
