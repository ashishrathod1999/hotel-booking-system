<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::resource('rooms', RoomController::class);
Route::resource('bookings', BookingController::class);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/occupancy-summary', [DashboardController::class, 'occupancySummary'])->name('dashboard.occupancySummary');

// web.php
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');


Route::post('/dashboard/bookings-by-date', [DashboardController::class, 'getBookingsByDate'])->name('dashboard.getBookingsByDate');






Route::post('/dashboard/bookings-by-date', [DashboardController::class, 'getBookingsByDate'])->name('dashboard.getBookingsByDate');
Route::post('/dashboard/room-bookings', [DashboardController::class, 'getRoomBookings'])->name('dashboard.getRoomBookings');


Route::get('/dashboard/occupancy-details', [DashboardController::class, 'getOccupancyDetails'])->name('dashboard.getOccupancyDetails');




