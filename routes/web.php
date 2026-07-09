<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SparePartController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Customer\VehicleController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\DashboardController;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class)->only(['index', 'update']);
        Route::resource('services', ServiceController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('categories', CategoryController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        Route::resource('spare-parts', SparePartController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update']);
        Route::get('reports/booking', [ReportController::class, 'booking'])->name('reports.booking');
        Route::get('reports/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
        Route::get('reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
    });

    // Customer
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::resource('vehicles', VehicleController::class)->except(['show']);
        Route::resource('bookings', CustomerBookingController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});