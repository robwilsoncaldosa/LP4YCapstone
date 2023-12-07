<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StripeController;
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

Route::get('/policy',function(){
    return view('policy');
})->name('policy');

Route::get('/login', [PersonnelController::class, 'showlogin'])->name('showlogin');

Route::post('/login', [PersonnelController::class, 'login'])->name('login');

Route::post('/logout', [PersonnelController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Retrieve user data from the session
        $user = session('user');

        // Ensure $user is defined before using it
        if ($user) {
            return view('dashboard', compact('user'));
        } else {
            // Handle the case where $user is not found
            return redirect('login')->with('error', 'User not found');
        }
    })->name('dashboard');
})->middleware('auth'); // Add auth middleware here as well




Route::get('/book', [RoomController::class, 'showBookingView'])->name('book');

Route::get('/rooms/{name}', [RoomController::class, 'moreinfo'])->name('moreinfo');

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('sendemail');



Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::post('/downpayment', [StripeController::class, 'createDownpaymentSession'])->name('downpayment');

Route::get('/success', [StripeController::class, 'success'])->name('success');

