<?php

use App\Http\Controllers\Web\Admin\DriverController;
use App\Http\Controllers\Web\Admin\VehicleBookingController;
use App\Http\Controllers\Web\Admin\VehicleController;
use App\Http\Controllers\Web\Approver\ApprovalController;
use App\Http\Controllers\Web\Auth\AdminDashboardController;
use App\Http\Controllers\Web\Auth\ApproverDashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Auth\AuthWebController;
use App\Http\Middleware\CheckRole;

// Auth routes
Route::get('/login', [AuthWebController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthWebController::class, 'login']);

Route::get('/register', [AuthWebController::class, 'showRegister']);
Route::post('/register', [AuthWebController::class, 'register']);

Route::post('/logout', [AuthWebController::class, 'logout'])->middleware('auth')->name('logout');

// Protected route
// ADMIN DASHBOARD
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/bookings', [VehicleBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [VehicleBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [VehicleBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}/edit', [VehicleBookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [VehicleBookingController::class, 'update'])->name('bookings.update');
    Route::patch('/bookings/{id}/cancel', [VehicleBookingController::class, 'cancel'])->name('bookings.cancel');

    // Vehicles CRUD
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Drivers CRUD
    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/drivers/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/drivers', [DriverController::class, 'store'])->name('drivers.store');
    Route::get('/drivers/{driver}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('/drivers/{driver}', [DriverController::class, 'destroy'])->name('drivers.destroy');

    Route::get('/profile', [AuthWebController::class, 'profile'])->name('profile');

    // admin
    Route::put('/profile', [AuthWebController::class, 'updateProfile'])->name('profile.update');

    Route::get('/export', [AdminDashboardController::class, 'export'])->name('export');
});

Route::middleware(['auth', CheckRole::class . ':approver_1,approver_2'])->prefix('approver')->name('approver.')->group(function () {
    Route::get('/dashboard', [ApproverDashboardController::class, 'index'])->name('dashboard');

    //Booking
    Route::get('/bookings', [ApprovalController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{id}/approve', [ApprovalController::class, 'approve'])->name('bookings.approve');
    Route::patch('/bookings/{id}/reject', [ApprovalController::class, 'reject'])->name('bookings.reject');

    Route::get('/profile', [AuthWebController::class, 'profile'])->name('profile');

    // approver
    Route::put('/profile', [AuthWebController::class, 'updateProfile'])->name('profile.update');
});
