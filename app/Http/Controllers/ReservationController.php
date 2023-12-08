<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;

use Carbon\Carbon;
class ReservationController extends Controller
{
    public function showReservations()
{
    $reservations = Reservation::all();

    return view('dashboard', ['reservations' => $reservations]);
}


public function homeView()
{
    // Calculate the total number of bookings
    $totalBookings = Reservation::count();
    
    // Calculate new clients this month
    $newClientsThisMonth = Reservation::whereMonth('check_in_date', '=', Carbon::now()->month)->count();
    
    // Calculate returning clients
    $returningClients = Reservation::distinct('user_id')
        ->where('check_in_date', '<', Carbon::now()) 
        ->count();

        return view('dashboard', [
        'totalBookings' => $totalBookings,
        'newClientsThisMonth' => $newClientsThisMonth,
        'returningClients' => $returningClients,
    ]);
}


public function checkout($reservationId)
{
    // Perform the checkout logic

    $reservation = Reservation::find($reservationId);

    event(new ReservationCheckedOut($reservation));

    // Return a response or redirect as needed
}

}
