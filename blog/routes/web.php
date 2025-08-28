<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\FacultyAuthController;

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// =========================
// Public Routes (No Auth Required)
// =========================
Route::get('/student-login', [StudentAuthController::class, 'showLoginForm'])->name('student.login.form');
Route::post('/student-login', [StudentAuthController::class, 'login'])->name('student.login.submit');
Route::get('/student-logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Faculty public routes
Route::get('/faculty-login', [FacultyAuthController::class, 'showLoginForm'])->name('faculty.login.form');
Route::get('/faculty/login', [FacultyAuthController::class, 'showLoginForm'])->name('auth.faculty.login');
Route::post('/faculty-login', [FacultyAuthController::class, 'login'])->name('faculty.login.submit');
Route::get('/faculty-logout', [FacultyAuthController::class, 'logout'])->name('faculty.logout');

// =========================
// Protected Routes (Students or Faculty)
// =========================
Route::middleware(['user.auth'])->group(function () {
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');

        // Comments
        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});
