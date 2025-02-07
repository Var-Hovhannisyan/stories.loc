<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'form'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/stories', [DashboardController::class, 'stories'])->middleware(['auth', 'verified'])->name('dashboard.stories');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/story/create', [StoryController::class, 'store'])->name('story.create');
    Route::get('/stories/{id}/approved', [StoryController::class, 'approved'])->name('story.approved');
});


require __DIR__.'/auth.php';
