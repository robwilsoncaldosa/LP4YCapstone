<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;

class PaymentController extends Controller
{

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        $payment = Payment::findOrFail($id);

        // Calculate the new amount by adding the existing amount to the user-input amount
        $newAmount = $payment->amount + $request->input('amount');

        // Check if the new amount is almost equal to the remaining balance
        $remainingBalance = $payment->reservation->room->price_per_night - $payment->amount;
        $tolerance = 0.01; // Adjust this tolerance value based on your precision requirements

        if (abs($newAmount - $payment->reservation->room->price_per_night) < $tolerance) {
            // If the difference is within the tolerance, set the new amount to the remaining balance
            $newAmount = $payment->reservation->room->price_per_night;
        } elseif ($newAmount > $payment->reservation->room->price_per_night) {
            return redirect()->route('dashboard.transactions', ['id' => $payment->id])
                ->with('error', "Overpriced Amount! Please check the remaining balance.");
        }

        // Update payment fields based on the calculated new amount
        $payment->update([
            'amount' => $newAmount,
            'remaining_total' => $payment->reservation->room->price_per_night - $newAmount,
            // Add other fields as needed
        ]);

        return redirect()->route('dashboard.transactions')->with('success', 'Payment updated successfully.');
    }





    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('dashboard.transactions')->with('success', 'Payment deleted successfully.');
    }


    public function showTransactions()
    {
        // Fetch payment data from the database
        $payments = Payment::with('reservation.user', 'reservation.room')->get();

        $rooms = Room::pluck('room_name', 'id');
        $reservations = Reservation::all();


        return view('dashboard', ['payments' => $payments, 'rooms' => $rooms, 'reservations' => $reservations]);
    }


    public function getTotalAmount()
    {
        $totalAmount = Payment::sum('amount');
        $totalRemainingBalance = Payment::sum('remaining_total');

        return response()->json([
            'totalAmount' => $totalAmount,
            'totalRemainingBalance' => $totalRemainingBalance,
        ]);
    }

    public function storeTransaction(Request $request)
    {
        // Validate the payment data here
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'amount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        // Retrieve the latest payment record based on the provided reservation_id
        $reservation = Payment::where('reservation_id', $request->input('reservation_id'))
            ->latest('created_at')
            ->firstOrFail();

            $remainingTotal= $reservation ->remaining_total = $reservation->remaining_total - $request->input('amount');



        // Create a payment for the reservation
         Payment::create([
            'reservation_id' => $reservation->id,
            'remaining_total' => $remainingTotal,
            'amount' => $request->input('amount'),
            'payment_method' => $request->input('payment_method'),
            // Add other payment fields as needed
        ]);

        // You can redirect to the transactions page or any other page after storing the payment
        return redirect()->route('dashboard.transactions')->with('success', 'Payment created successfully!');
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



}
