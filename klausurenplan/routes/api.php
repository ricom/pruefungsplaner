<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CsvController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\SupervisorController;
use App\Http\Controllers\API\ExamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload-csv', [CsvController::class, 'store'])->name('csv.upload');
Route::apiResource('csv', CsvController::class);

Route::post('/api/supervisors', [SupervisorController::class, 'store']);
Route::apiResource('supervisors', SupervisorController::class);

Route::post('/api/rooms', [RoomController::class, 'store']);
Route::apiResource('rooms', RoomController::class);