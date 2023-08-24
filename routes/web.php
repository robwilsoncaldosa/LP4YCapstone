<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MailController;

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



    Route::get('/rooms/{name}', [RoomController::class,'moreinfo'])->name('moreinfo');


    Route::post('/send-email', [ContactController::class,'sendEmail'])->name('sendemail');

    Route::get('/send-mail', [MailController::class, 'index']);

