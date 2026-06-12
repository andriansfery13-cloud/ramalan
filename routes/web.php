<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/leaderboard', \App\Livewire\LiveLeaderboard::class)->name('leaderboard');

Route::get('/overlay', function () {
    return view('overlay');
})->name('overlay');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (User & Admin)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    // Livewire Feature Routes
    Route::get('/ramalan', \App\Livewire\FortuneGenerator::class)->name('ramalan');
    Route::get('/arti-nama', \App\Livewire\NameAnalysis::class)->name('arti-nama');
    Route::get('/cocok-nama', \App\Livewire\NameMatchComponent::class)->name('cocok-nama');
    Route::get('/battle-nama', \App\Livewire\NameBattle::class)->name('battle-nama');
    Route::get('/aura', \App\Livewire\AuraDetector::class)->name('aura');
    Route::get('/roast', \App\Livewire\RoastGenerator::class)->name('roast');
    Route::get('/spinner', \App\Livewire\SpinnerWheel::class)->name('spinner');
    Route::get('/cek-khodam', \App\Livewire\KhodamCheck::class)->name('cek-khodam');
});

// Admin Routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/mode', \App\Livewire\Admin\ModeSettings::class)->name('mode');

    Route::get('/templates', \App\Livewire\Admin\TemplateManager::class)->name('templates');
    Route::get('/categories', \App\Livewire\Admin\CategoryManager::class)->name('categories');
    Route::get('/openai', function() { return redirect()->route('admin.mode'); })->name('openai');
    Route::get('/tiktok', \App\Livewire\Admin\TiktokSettings::class)->name('tiktok');
    Route::get('/overlay-settings', \App\Livewire\Admin\OverlaySettings::class)->name('overlay');
    Route::get('/statistics', \App\Livewire\Admin\Statistics::class)->name('statistics');
    Route::get('/users', \App\Livewire\Admin\UserManager::class)->name('users');
    Route::get('/settings', \App\Livewire\Admin\GeneralSettings::class)->name('settings');
});
