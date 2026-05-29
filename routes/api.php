<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

// HTTP METHODS
// POST CREATE
// GET READ
// PUT UPDATE
// DELETE DELETE

// Route::get('/students', [StudentController::class, 'show']);
// Route::post('/students', [StudentController::class, 'create']);
// Route::delete('/students/{id}', [StudentController::class, 'delete']);


Route::apiResource('students', StudentController::class);

Route::post('/time-in', [AttendanceController::class, 'timeIn']);
Route::post('/time-out', [AttendanceController::class, 'timeOut']);
Route::get('/logs', [AttendanceController::class, 'logs']);

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/add', [AuthController::class, 'add']);
});