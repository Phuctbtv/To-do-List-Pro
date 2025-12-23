<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// ========== TRANG CHỦ ==========
// Khi truy cập localhost:8000
Route::get('/', function () {
    if (auth()->check()) {
        // Nếu đã login, redirect theo role
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.dashboard')
            : redirect()->route('tasks.index');
    }
    // Chưa login -> trang login
    return redirect()->route('login');
});

// ========== ROUTE DASHBOARD MẶC ĐỊNH ==========
// User thường KHÔNG ĐƯỢC vào, redirect về tasks
// Admin cũng KHÔNG vào đây, mà vào /admin/dashboard
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            // Admin: redirect đến admin dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // User thường: redirect đến tasks
            return redirect()->route('tasks.index');
        }
    }
    // Chưa login -> login
    return redirect()->route('login');
})->middleware(['auth'])->name('dashboard');

// ========== ROUTE PROFILE ==========
// Cả admin và user đều vào được
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========== ROUTE CHO TASKS ==========
// Trang chính cho user thường sau khi login
Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::get('/{task}', [TaskController::class, 'show'])->name('show');
    Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{task}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
});

// ========== ADMIN ROUTES ==========
// CHỈ ADMIN mới vào được, bảo vệ bằng middleware 'admin'
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard admin - TRANG DUY NHẤT admin được vào
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Quản lý users
    Route::resource('users', UserController::class)->except(['edit', 'update']);
    
    // Route bổ sung cho users
    Route::post('/users/{user}/make-admin', [UserController::class, 'makeAdmin'])
         ->name('users.makeAdmin');
});

// ========== AUTH ROUTES (login, register, etc.) ==========
require __DIR__.'/auth.php';