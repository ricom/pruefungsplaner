<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Redirect '/' to '/klausurplan'
Route::redirect('/', '/klausurplan');

// Redirect '/dashboard' to '/klausurplan'
Route::redirect('/dashboard', '/klausurplan');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/klausurplan', 'klausurplan')->name('klausurplan');
    Route::view('/supervisors', 'supervisors')->name('supervisors');
    Route::view('/rooms', 'rooms')->name('rooms');
    Route::view('/upload-csv', 'upload-csv')->name('upload-csv');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
