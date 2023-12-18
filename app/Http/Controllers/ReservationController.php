<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\User;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class ReservationController extends Controller
{

    public function getReservedDatesByRoom($room_id)
    {
        $reservations = Reservation::where('room_id', $room_id)->get();

        $reservedDates = [];

        foreach ($reservations as $reservation) {
            $reservedDates[] = $reservation->check_in_date;

            // Include the check_out_date as well, excluding the last day
            $checkOutDate = date('Y-m-d', strtotime($reservation->check_out_date));
            $reservedDates[] = $checkOutDate;
        }

        return response()->json(['reservations' => $reservations, 'reservedDates' => $reservedDates]);
    }



    public function showReservations()
{
    $reservations = Reservation::all();

    $rooms = Room::pluck('room_name', 'id');


    return view('dashboard', ['reservations' => $reservations, 'rooms' => $rooms]);

    // return view('dashboard', ['reservations' => $reservations]);
}
public function homeView()
{
    // Calculate the total number of bookings
    $totalBookings = Reservation::count();

    // Calculate new clients this month
    $newClientsThisMonth = Reservation::whereMonth('check_in_date', '=', now()->month)->count();

    // Calculate returning clients
    $returningClients = Reservation::distinct('user_id')
        ->where('check_in_date', '<', now())
        ->count();

    // Fetch room status data
    $roomStatuses = Room::select('room_name', DB::raw("CASE WHEN reservations.check_out_date >= CURRENT_TIMESTAMP THEN CONCAT('Occupied until ', TO_CHAR(reservations.check_out_date, 'FMMonth FMDD, YYYY at HH12:MI AM')) ELSE 'Available' END as status"))
        ->leftJoin('reservations', function ($join) {
            $join->on('rooms.id', '=', 'reservations.room_id')
                ->where('reservations.check_out_date', '=', DB::raw('(SELECT MAX(check_out_date) FROM reservations WHERE room_id = rooms.id)'));
        })
        ->get();

    // Fetch all reservations data
    $reservations = Reservation::all();

    return view('dashboard', [
        'totalBookings' => $totalBookings,
        'newClientsThisMonth' => $newClientsThisMonth,
        'returningClients' => $returningClients,
        'reservations' => $reservations,
        'roomStatuses' => $roomStatuses,
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







public function storeReservation(Request $request)
{
    // Validate and store your transaction data here
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'country_code' => 'required|string', // Add validation for the country code
        'phone3' => 'required|string', // Add validation for the mobile number
        'room_id' => 'required|exists:rooms,id',
        'amount' => 'required|numeric|min:0',
        'payment_method' => 'required|string',
        'check_in_date' => 'required|date',
        // 'check_in_time' => 'required|date_format:H:i',
        'check_out_date' => 'required|date',
        // 'check_out_time' => 'required|date_format:H:i',
    ]);

    // Combine date and time strings for check-in and check-out
    $checkInDateTime = $request->input('check_in_date') . ' ' . $request->input('check_in_time');
    $checkOutDateTime = $request->input('check_out_date') . ' ' . $request->input('check_out_time');

    // Check if the chosen room is currently occupied or not available
    $isRoomAvailable = $this->isRoomAvailable($request->input('room_id'), $checkInDateTime, $checkOutDateTime);

    if (!$isRoomAvailable) {
        return redirect()->route('dashboard.transactions')->with('error', 'The chosen room is not available at this chosen date.');
    }

    // Create or find the user based on the provided email
    $user = User::firstOrCreate(
        ['email' => $request->input('email')],
        [
            'name' => $request->input('name'),
            'contact_number' => $request->input('phone3'),
        ]
    );

    // Create a reservation for the user
    $reservation = Reservation::create([
        'user_id' => $user->id,
        'room_id' => $request->input('room_id'),
        'check_in_date' => $checkInDateTime,
        'check_out_date' => $checkOutDateTime,
        // Add other reservation fields as needed
    ]);

    // Create a payment for the reservation
    $payment = Payment::create([
        'reservation_id' => $reservation->id,
        'remaining_total' => $reservation->room->price_per_night - $request->input('amount'),
        'amount' => $request->input('amount'),
        'payment_method' => $request->input('payment_method'),
        // Add other payment fields as needed
    ]);

    // You can redirect to the transactions page or any other page after storing
    return redirect()->route('dashboard.reservations')->with('success', 'Transaction created successfully!');
}

/**
 * Check if the room is available for the given dates.
 *
 * @param int $roomId
 * @param string $checkInDateTime
 * @param string $checkOutDateTime
 * @return bool
 */
private function isRoomAvailable($roomId, $checkInDateTime, $checkOutDateTime)
{

    $existingReservations = Reservation::where('room_id', $roomId)
        ->where(function ($query) use ($checkInDateTime, $checkOutDateTime) {
            $query->whereBetween('check_in_date', [$checkInDateTime, $checkOutDateTime])
                ->orWhereBetween('check_out_date', [$checkInDateTime, $checkOutDateTime]);
        })
        ->exists();

    return !$existingReservations;
}







// Will check and get the name of the guest from the prevs guest list
public function checkUserByEmail(Request $request)
{
    $email = $request->input('email');

    // Check if the user with the given email exists
    $user = User::where('email', $email)->first();

    if ($user) {
        // If the user exists, return the user's name
        return Response::json(['success' => true, 'name' => $user->name]);
    } else {
        // If the user doesn't exist, return a response indicating that
        return Response::json(['success' => false]);
    }
}






}
