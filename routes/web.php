<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Models\Reservation;
use Carbon\Carbon;



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
    $reviews = \App\Models\Review::all();
    return view('app', ['reviews' => $reviews]);
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

        $totalBookings = Reservation::count();
    
        // Calculate new clients this month
        $newClientsThisMonth = Reservation::whereMonth('created_at', '=', Carbon::now()->month)->count();
        
        // Calculate returning clients
        $returningClients = Reservation::distinct('user_id')
            ->where('check_in_date', '<', Carbon::now()) // Assuming check_in_date is your timestamp for reservations
            ->count();

        // Ensure $user is defined before using it
        if ($user) {

            // return view('dashboard', compact('user'));

            return view('dashboard', [
                'user' => $user,
                'totalBookings' => $totalBookings,
                'newClientsThisMonth' => $newClientsThisMonth,
                'returningClients' => $returningClients,
            ]);



        } else {
            // Handle the case where $user is not found
            ddd($user);
            return redirect('login')->with('error', 'User not found');
        }
    })->name('dashboard');
 


    
    Route::get('/dashboard/reservations', [ReservationController::class, 'showReservations'])->name('dashboard.reservations');
    Route::get('/dashboard/home', [ReservationController::class, 'homeView'])->name('dashboard.home');
    Route::get('/dashboard/rooms', [RoomController::class, 'showAllRooms'])->name('dashboard.rooms');
    Route::get('/dashboard/roomStatuses', [RoomController::class, 'showRoomStatus'])->name('dashboard.roomStatuses');
    Route::get('/dashboard/users', [UserController::class, 'showAllUsers'])->name('dashboard.users');
    Route::get('/dashboard/personnel', [PersonnelController::class, 'viewPersonnels'])->name('dashboard.personnel');
    
    Route::post('/dashboard/personnel/store', [PersonnelController::class, 'store'])->name('personnel.store');
    Route::get('/dashboard/personnel/{id}', [PersonnelController::class, 'show'])->name('personnel.show');
    Route::get('/dashboard/personnel/{id}/edit', [PersonnelController::class, 'edit'])->name('personnel.edit');
    Route::delete('/dashboard/personnel/{id}', [PersonnelController::class, 'destroy'])->name('personnel.destroy');
});





Route::get('/book', [RoomController::class, 'showBookingView'])->name('book');

Route::get('/rooms/{name}', [RoomController::class, 'moreinfo'])->name('moreinfo');

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('sendemail');



Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::post('/downpayment', [StripeController::class, 'createDownpaymentSession'])->name('downpayment');

Route::get('/success', [StripeController::class, 'success'])->name('success');

Route::get('/dashboard/reservations', [ReservationController::class, 'showReservations'])->name('dashboard.reservations');


Route::get('/write-review/{reservation}', [ReviewController::class, 'showReviewPopup'])->name('review')->middleware('auth');
Route::post('/submit-review/{reservation}', [ReviewController::class, 'submitReview'])->name('submit-review')->middleware('auth');




