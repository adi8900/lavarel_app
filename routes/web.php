<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRepairController;
use App\Http\Controllers\AdminRepairController;

// Public routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/repairs', [UserRepairController::class, 'index'])->name('user.repairs'); // User's repairs
});

// Admin routes
Route::middleware([CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard'); // Admin dashboard view
    })->name('admin.dashboard');

    Route::resource('/admin/repairs', AdminRepairController::class); // Full CRUD for repairs
});