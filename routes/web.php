<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;

Route::get('/', fn () => redirect()->route('posts.index'));

// Logged-in only (must come BEFORE the public resource, or "create" is mistaken for a post ID)
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Public
Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
