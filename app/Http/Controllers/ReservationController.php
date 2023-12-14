<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;
class ReservationController extends Controller
{



    public function showReservations()
{
    $reservations = Reservation::all();

    $rooms = Room::pluck('room_name', 'id');


    return view('dashboard', ['reservations' => $reservations, 'rooms' => $rooms]);

    // return view('dashboard', ['reservations' => $reservations]);
}


public function homeView()
{
    $reservations = Reservation::all();

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
        'reservations' => $reservations,
    ]);
}


public function checkout($reservationId)
{
    // Perform the checkout logic

    $reservation = Reservation::find($reservationId);

    event(new ReservationCheckedOut($reservation));

    // Return a response or redirect as needed
}

public function updateReservation(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    // Validate and update reservation data here
    $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'check_in_date' => 'required|date',
        'check_in_time' => 'required|date_format:H:i',
        'check_out_date' => 'required|date',
        'check_out_time' => 'required|date_format:H:i',
        // Add other validation rules as needed
    ]);

    // Update reservation fields based on the form data
    $reservation->update([
        'room_id' => $request->input('room_id'),
        'check_in_date' => $request->input('check_in_date'),
        'check_in_time' => $request->input('check_in_time'),
        'check_out_date' => $request->input('check_out_date'),
        'check_out_time' => $request->input('check_out_time'),
        // Update other reservation fields as needed
    ]);

    // Redirect back to the reservations page with a success message
    return redirect()->route('dashboard.reservations')->with('success', 'Reservation updated successfully.');
}


public function cancelReservation($id)
{
    $reservation = Reservation::findOrFail($id);

    // In here still need to decide if the canceled reservation will be stored or viewed by the staff or admin.
    // Delete the reservation
    $reservation->delete();

    // Redirect back to the reservations page with a success message
    return redirect()->route('dashboard.reservations')->with('success', 'Reservation canceled successfully.');
}




}
