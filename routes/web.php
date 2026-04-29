<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
// AboutController usage removed; revert to legacy view for /about
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Admin routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects management
    Route::resource('projects', ProjectController::class)->except(['show']);

    // Messages management
    Route::get('/messages', [ContactController::class, 'adminIndex'])->name('messages.index');
    Route::get('/messages/{contact}', [ContactController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{contact}', [ContactController::class, 'destroy'])->name('messages.destroy');

    // Skills management
    Route::resource('skills', 'App\Http\Controllers\SkillController');
});

// require __DIR__.'/auth.php';
