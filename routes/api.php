<?php

use App\Http\Controllers\API\CarSearchController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\AvailableCarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/available-cars', [CarSearchController::class, 'getAvailableCars']);
});
Route::post('/auth/login', [LoginController::class, '__invoke']);
