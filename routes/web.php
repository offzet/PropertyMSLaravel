<?php

//Mark Andrew S. Baliguat && John Irish C. Jacinto == BSIT 4-2

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\RepairController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ApplicationController;
use App\Http\Controllers\Customer\LeaseController;
use App\Http\Controllers\Customer\RepairController as CustomerRepairController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Dashboard Routes
Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin.dashboard');

// Admin Routes Group
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Properties Routes
    Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
    Route::resource('/properties', PropertyController::class);

    // Tenants Routes
    Route::get('/tenants/search', [TenantController::class, 'search'])->name('tenants.search');
    Route::resource('/tenants', TenantController::class);

    // Repairs Routes
    Route::get('/repairs/search', [RepairController::class, 'search'])->name('repairs.search');
    Route::get('/repairs/{repair}/get-tenants', [RepairController::class, 'getTenantsByProperty'])->name('repairs.get-tenants');
    Route::get('/repairs/{repair}/get-properties', [RepairController::class, 'getPropertiesByTenant'])->name('repairs.get-properties');
    Route::resource('/repairs', RepairController::class);
});

// Customer Routes Group
Route::prefix('customer')->name('customer.')->middleware(['auth', 'verified', 'user'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');


    // Properties
    Route::get('/properties', [DashboardController::class, 'properties'])->name('properties.index');
    Route::get('/properties/ajax-search', [DashboardController::class, 'ajaxSearch'])->name('properties.ajax-search');
    Route::get('/properties/{property}', [DashboardController::class, 'showProperty'])->name('properties.show');

    // Applications
    Route::get('/properties/{property}/apply', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/properties/{property}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');

    // Leases (My Rentals)
    Route::get('/leases', [LeaseController::class, 'index'])->name('leases.index');
    Route::get('/leases/{tenant}', [LeaseController::class, 'show'])->name('leases.show');

    // Repairs
    Route::get('/repairs', [CustomerRepairController::class, 'index'])->name('repairs.index');
    Route::get('/repairs/create', [CustomerRepairController::class, 'create'])->name('repairs.create');
    Route::post('/repairs', [CustomerRepairController::class, 'store'])->name('repairs.store');
    Route::get('/repairs/{repair}', [CustomerRepairController::class, 'show'])->name('repairs.show');
    Route::get('/repairs/{repair}/success', [CustomerRepairController::class, 'success'])->name('repairs.success');
    Route::get('/tenants/{tenantId}/properties', [CustomerRepairController::class, 'getTenantProperties'])->name('repairs.tenant-properties');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Socialite Routes
Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

require __DIR__ . '/auth.php';
