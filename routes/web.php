<?php

use App\Http\Controllers\RoomController;
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
        return view('app');
    })->name('app');

    Route::get('/book', [RoomController::class,'showBookingView'])->name('book');

    Route::get('/room_details', function () {
        return view('room_details');
    })->name('room_details');



