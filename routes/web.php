<?php

use App\Http\Controllers\BlabController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlabController::class, 'index']);

Route::post('/blabs', [BlabController::class, 'store']);
Route::get('/blabs/{blab}/edit', [BlabController::class, 'edit']);
Route::put('/blabs/{blab}', [BlabController::class, 'update']);
Route::delete('/blabs/{blab}', [BlabController::class, 'destroy']);