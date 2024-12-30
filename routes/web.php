<?php

use App\Http\Controllers\AvailableCarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web', backpack_middleware()])->group(function () {
    Route::get('/admin/dashboard', [AvailableCarController::class,'filter'])->name('car.bookings.dashboard');
    Route::get('/admin/bookings/filter', [AvailableCarController::class,'filter'])->name('car.bookings.filter');
});
