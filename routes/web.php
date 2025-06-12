<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [TasksController::class, 'index'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TasksController::class)->only([
        'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';