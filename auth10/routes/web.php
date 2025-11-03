<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard');


Route::get('/user/dashboard', function () {
    return view('user-dashboard');
})->middleware(['auth'])->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User management routes - protected by admin middleware
    Route::middleware('admin')->group(function () {
        Route::get('/users/{user}/edit', [DashboardController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [DashboardController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [DashboardController::class, 'deleteUser'])->name('users.destroy');
    });
});

require __DIR__.'/auth.php';