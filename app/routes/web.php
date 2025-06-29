<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    //Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
    //Route::resource('orders', \App\Http\Controllers\Client\OrderController::class)->only(['index', 'create', 'store']);
});

Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    //Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    //Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
