<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Tasks\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->prefix('tasks')->group(function () {
    Route::post('/', [TaskController::class, 'createTask']);
    Route::get('/', [TaskController::class, 'getAllTasks']);
    Route::get('/{task}', [TaskController::class, 'getTask']);
    Route::put('/{task}', [TaskController::class, 'updateTask']);
    Route::delete('/{task}', [TaskController::class, 'deleteTask']);
});
