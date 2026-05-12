<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\McuController;
use App\Http\Controllers\McuViewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Models\RegSIMRS;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/tesodbc', function(){
    dd(RegSIMRS::get());
});

// =====================
// AUTH REQUIRED
// =====================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])
        ->name('dashboard');

    // User Management
    Route::resource('user', UserController::class);
    Route::put('/user/{id}/reset-password', [UserController::class, 'resetPassword'])
        ->name('user.reset-password');

    // Change Password
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])
        ->name('password.change');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])
        ->name('password.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // =====================
    // LEVEL 3
    // =====================
    Route::middleware('level:3')->group(function () {
        Route::get('/mcu', [McuViewController::class, 'index'])->name('mcu.index');
        Route::get('/mcu/{id}', [McuViewController::class, 'show'])->name('mcu.show');
    });

    // =====================
    // LEVEL 2
    // =====================
    Route::middleware('level:2')->group(function () {
        Route::get('/capture', [McuController::class, 'index'])->name('capture');
        Route::post('/mcu/store', [McuController::class, 'store'])->name('mcu.store');
    });

});

require __DIR__.'/auth.php';