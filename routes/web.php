<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRepairController;
use App\Http\Controllers\AdminRepairController;
use App\Http\Controllers\ReviewController;

// Public routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // Home page or welcome page

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // User's repairs
    Route::get('/repairs', [UserRepairController::class, 'index'])->name('user.repairs');
    
    // User can post reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware(['auth', CheckRole::class . ':worker'])->group(function () {
    Route::get('/worker/repairs', [UserRepairController::class, 'workerIndex'])->name('worker.repairs');
});

// Public review route (view all reviews)
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

// Admin routes
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard'); // Admin dashboard view
    })->name('admin.dashboard');

    // Resource routes for repairs (admin only)
    Route::resource('/admin/repairs', AdminRepairController::class);

    // Admin can delete reviews
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
