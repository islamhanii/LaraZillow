<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controllers\IndexController::class, 'index'])->name('index');
Route::get('/show', [Controllers\IndexController::class, 'show'])->name('show');

Route::get('/login', [Controllers\AuthController::class, 'create'])->name('login');
Route::post('/login', [Controllers\AuthController::class, 'store'])->name('login.store');
Route::delete('/logout', [Controllers\AuthController::class, 'destroy'])->name('logout');

Route::resource('listing', Controllers\ListingController::class)->only(['index', 'show']);

Route::resource('user-account', Controllers\UserAccountController::class)->only(['create', 'store']);

Route::prefix('realtor')->name('realtor.')->group(function () {
    Route::resource('listing', Controllers\RealtorListingController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->withTrashed();
    Route::put('listing/{listing}/restore', [Controllers\RealtorListingController::class, 'restore'])->name('listing.restore')->withTrashed();
});
