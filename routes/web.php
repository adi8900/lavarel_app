<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserRepairController;
use App\Http\Controllers\AdminRepairController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\WorkerRepairController;

// Public routes
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::prefix('/user')->group(function () {
        Route::get('/repairs', [UserRepairController::class, 'index'])->name('user.repairs');
    });

    Route::prefix('/reviews')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
        Route::put('/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    });
});

// Worker routes
Route::middleware(['auth', CheckRole::class . ':worker'])->prefix('/worker')->group(function () {
    Route::get('/repairs', [WorkerRepairController::class, 'index'])->name('worker.repairs');

    // Create new repair page
    Route::get('/repairs/create', [WorkerRepairController::class, 'create'])->name('worker.repairs.create');
    
    // Edit repair page
    Route::get('/repairs/{repair}/edit', [WorkerRepairController::class, 'edit'])->name('worker.repairs.edit');
    
    // Update repair
    Route::put('/repairs/{repair}', [WorkerRepairController::class, 'update'])->name('worker.repairs.update');
    
    // Store new repair
    Route::post('/repairs', [WorkerRepairController::class, 'store'])->name('worker.repairs.store');
    
    // Delete repair
    Route::delete('/repairs/{repair}', [WorkerRepairController::class, 'destroy'])->name('worker.repairs.destroy');
});

// Admin routes
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Resource routes for repairs
    Route::resource('/repairs', AdminRepairController::class);

    // Manage reviews
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Manage users
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index'); // List users
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); // Delete user
});
