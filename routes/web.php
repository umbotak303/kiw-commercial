<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SlideItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Admin Panel Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/seed-defaults', [DashboardController::class, 'seedDefaults'])->name('seed.defaults');

    // Settings & Theme Customizer
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Slides Management
    Route::resource('slides', SlideController::class)->except(['show']);

    // Slide Items Management
    Route::get('/slides/{slide}/items', [SlideItemController::class, 'index'])->name('slides.items.index');
    Route::get('/slides/{slide}/items/create', [SlideItemController::class, 'create'])->name('slides.items.create');
    Route::post('/slides/{slide}/items', [SlideItemController::class, 'store'])->name('slides.items.store');
    Route::get('/items/{item}/edit', [SlideItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [SlideItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [SlideItemController::class, 'destroy'])->name('items.destroy');
});
