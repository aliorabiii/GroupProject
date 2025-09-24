<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\RoleController;


use App\Http\Controllers\AboutController;

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');




Route::get('/index', function () { return view('pages.index'); });
Route::get('/contact', function () { return view('pages.contact'); });
Route::get('/features', function () { return view('pages.features'); });
Route::get('/services', function () { return view('pages.services'); });
Route::get('/testimonials', function () { return view('pages.testimonials'); });
Route::get('/', function () { return view('welcome'); });

// ------------------------
// Dashboard - authenticated & verified users
// ------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// ------------------------
// TEMPORARY: Superadmin routes - accessible to ANY authenticated user
// Remove 'role:super-admin' middleware for now
// ------------------------
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/superadmin/admins', [AdminManagementController::class, 'index'])
        ->name('superadmin.admins.index');
    Route::get('/superadmin/admins/create', [AdminManagementController::class, 'create'])
        ->name('superadmin.admins.create');
    Route::post('/superadmin/admins', [AdminManagementController::class, 'store'])
        ->name('superadmin.admins.store');
    Route::get('/superadmin/admins/{admin}/edit', [AdminManagementController::class, 'edit'])
        ->name('superadmin.admins.edit');
    Route::put('/superadmin/admins/{admin}', [AdminManagementController::class, 'update'])
        ->name('superadmin.admins.update');
    Route::delete('/superadmin/admins/{admin}', [AdminManagementController::class, 'destroy'])
        ->name('superadmin.admins.destroy');

    Route::post('/superadmin/roles', [RoleController::class, 'store'])
        ->name('superadmin.roles.store');
});


// ------------------------
// Profile routes - authenticated users
// ------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------------
// Auth routes (Breeze / Jetstream)
// ------------------------
require __DIR__.'/auth.php';
