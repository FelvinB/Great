<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// HTTP METHODS
// POST CREATE
// GET READ
// PUT UPDATE
// DELETE DELETE

// Route::get('/students', [StudentController::class, 'show']);
// Route::post('/students', [StudentController::class, 'create']);
// Route::delete('/students/{id}', [StudentController::class, 'delete']);

Route::prefix('auth')->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

});