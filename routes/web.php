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
use App\Http\Controllers\PaymentController;
use App\Models\Reservation;
use App\Models\room;
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

            return redirect('login')->with('error', 'User not found');
        }
    })->name('dashboard');






Route::post('/reservations/checkUserByEmail', [ReservationController::class, 'checkUserByEmail'])->name('dashboard.reservations.checkUserByEmail');

    Route::post('/reservations/storeReservation', [ReservationController::class, 'storeReservation'])->name('dashboard.reservations.storeReservation');

    Route::put('/dashboard/reservations/update/{id}', [ReservationController::class, 'update'])->name('dashboard.reservations.update');

    Route::delete('/dashboard/reservations/cancel/{id}', [ReservationController::class, 'cancelReservation'])->name('dashboard.reservations.cancel');
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

    // Create room
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

// Update room
Route::put('dashboard/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');

// Delete room
    Route::delete('/rooms/{id}', [RoomController::class, 'destroy'])->name('rooms.destroy');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/personnel/reset-password/{id}', [PersonnelController::class, 'resetPassword'])->name('personnel.resetPassword');


    Route::get('/dashboard/transactions', [PaymentController::class, 'showTransactions'])->name('dashboard.transactions');
    // Route::get('/dashboard/transactions/{id}/edit', [PaymentController::class, 'edit'])->name('dashboard.transactions.edit');
    Route::put('/dashboard/transactions/{id}', [PaymentController::class, 'update'])->name('dashboard.transactions.update');
    Route::delete('/dashboard/transactions/{id}', [PaymentController::class, 'destroy'])->name('dashboard.transactions.destroy');
    Route::get('/dashboard/transactions/total-amount', [PaymentController::class, 'getTotalAmount']);


    // Route::get('dashboard/transactions/rooms', [PaymentController::class, 'createTransaction'])->name('dashboard.transactions.rooms');
    Route::post('/transactions/storeTransaction', [PaymentController::class, 'storeTransaction'])->name('dashboard.transactions.storeTransaction');

    Route::get('dashboard/reviews', [ReviewController::class, 'showReviews'])->name('dashboard.reviews');


    Route::delete('/dashboard/reviews/delete/{id}', [ReviewController::class, 'deleteReview'])->name('dashboard.reviews.delete');



});






Route::get('/allreviews', [ReviewController::class, 'showAllReviews'])->name('all-reviews');

Route::get('/book', [RoomController::class, 'showBookingView'])->name('book');

Route::get('/rooms/{name}', [RoomController::class, 'moreinfo'])->name('moreinfo');

Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('sendemail');



Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::post('/downpayment', [StripeController::class, 'createDownpaymentSession'])->name('downpayment');

Route::get('/success', [StripeController::class, 'success'])->name('success');

Route::get('/dashboard/reservations', [ReservationController::class, 'showReservations'])->name('dashboard.reservations');


// Route::get('/write-review/{reservation}', [ReviewController::class, 'showReviewPopup'])->name('review')->middleware('auth');
// Route::post('/submit-review/{reservation}', [ReviewController::class, 'submitReview'])->name('submit-review')->middleware('auth');


Route::get('/write-review', [ReviewController::class, 'showReviewForm'])->name('review');
Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit-review');

// <!-- <form action="{{ route('submit-review', ['reservation' => $reservation->id]) }}" method="post" id="review-form"> -->
Route::get('/get-room-id/{room_name}', [ReviewController::class, 'getRoomId']);
Route::get('/more_info/{room_name}', [ReviewController::class, 'showAllReviewsForRoom'])->name('more_info');
