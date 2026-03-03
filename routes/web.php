<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Compositions - all authenticated users can view
    Route::get('/compositions', [CompositionController::class, 'index'])->name('compositions.index');
    Route::get('/compositions/{composition}', [CompositionController::class, 'show'])->name('compositions.show');

    // Compositions - only composers and admins can create
    Route::get('/compositions/create', [CompositionController::class, 'create'])->name('compositions.create')->middleware('role:composer|admin');
    Route::post('/compositions', [CompositionController::class, 'store'])->name('compositions.store')->middleware('role:composer|admin');

    // Compositions - owner or admin only (enforced via Policy)
    Route::get('/compositions/{composition}/edit', [CompositionController::class, 'edit'])->name('compositions.edit');
    Route::put('/compositions/{composition}', [CompositionController::class, 'update'])->name('compositions.update');
    Route::delete('/compositions/{composition}', [CompositionController::class, 'destroy'])->name('compositions.destroy');

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::patch('/compositions/{composition}/status', [CompositionController::class, 'updateStatus'])->name('compositions.updateStatus');
    });
});

require __DIR__.'/auth.php';