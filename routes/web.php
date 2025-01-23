<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRepairController;
use App\Http\Controllers\AdminRepairController;
use App\Http\Controllers\ReviewController;

// Public routes
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome'); // Home page or welcome page

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // User dashboard or repairs
    Route::prefix('/user')->group(function () {
        Route::get('/repairs', [UserRepairController::class, 'index'])->name('user.repairs');
    });

    // Reviews
    Route::prefix('/reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('reviews.index'); // Public view
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store'); // Authenticated users
        Route::put('/{review}', [ReviewController::class, 'update'])->name('reviews.update'); // Update review
    });
});

// Worker routes
Route::middleware(['auth', CheckRole::class . ':worker'])->prefix('/worker')->group(function () {
    Route::get('/repairs', [UserRepairController::class, 'workerIndex'])->name('worker.repairs');
    Route::get('/dashboard', function () {
        return view('worker.dashboard'); // Create `resources/views/worker/dashboard.blade.php`
    })->name('worker.dashboard');
});

// Admin routes
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard view
    })->name('admin.dashboard');

    // Resource routes for repairs
    Route::resource('/repairs', AdminRepairController::class);

    // Manage reviews
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
