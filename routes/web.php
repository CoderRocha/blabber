<?php

use App\Http\Controllers\BlabController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlabController::class, 'index']);
