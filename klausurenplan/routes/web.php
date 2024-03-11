<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/create-supervisor', 'create-supervisor')->name('create-supervisor');
    Route::view('/update-supervisor', 'update-supervisor')->name('update-supervisor');
    Route::view('/create-room', 'create-room')->name('create-room');
    Route::view('/update-room', 'update-room')->name('update-room');
    Route::view('/upload-csv', 'upload-csv')->name('upload-csv');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
