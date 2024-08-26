<?php

use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/about', function () {
    return Inertia::render('About', [
        'name' => 'Anderson Henrique da Silva',
        'course' => 'Inertia Vue + Laravel',
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create', [PostController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/store', [PostController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/edit/{id}', [PostController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [PostController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/destroy/{id}', [PostController::class, 'destroy'])->name('dashboard.destroy');
});
