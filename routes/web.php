<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\BlabController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlabController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::post('/blabs', [BlabController::class, 'store']);
    Route::get('/blabs/{blab}/edit', [BlabController::class, 'edit']);
    Route::put('/blabs/{blab}', [BlabController::class, 'update']);
    Route::delete('/blabs/{blab}', [BlabController::class, 'destroy']);
});

// register routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

// logout
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

// login
Route::view('/login', 'auth.login')
    ->middleware('guest');
    
Route::post('/login', Login::class)
    ->middleware('guest');