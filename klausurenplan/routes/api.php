<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CsvController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\SupervisorController;
use App\Http\Controllers\API\ExamController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// CSV Upload Route
Route::post('/upload-csv', [CsvController::class, 'store'])->name('csv.upload');
Route::apiResource('csv', CsvController::class);

// Supervisor Routes
Route::post('/api/supervisors', [SupervisorController::class, 'store']);
Route::apiResource('supervisors', SupervisorController::class);

// Room Routes
Route::post('/api/rooms', [RoomController::class, 'store']);
Route::apiResource('rooms', RoomController::class);

// Exam Routes
Route::get('/exams', [ExamController::class, 'index']); // List all exams
Route::get('/exams/{faculty}/{semester}', [ExamController::class, 'show']); // Show exams by faculty and semester
Route::put('/exams', [ExamController::class, 'update']); // Update exams
