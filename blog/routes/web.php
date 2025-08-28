<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// =========================
// Post Routes
// =========================

// Show all posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Show form to create a post
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Store a new post
Route::post('/posts/add', [PostController::class, 'store'])->name('posts.store');

// Show a single post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Show edit form
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Update a post
Route::put('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');

// Delete a post
Route::delete('/posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.destroy');

// =========================
// Comment Routes
// =========================

// Add a comment to a post
Route::post('/posts/{post}/comments/add', [CommentController::class, 'store'])->name('comments.store');
