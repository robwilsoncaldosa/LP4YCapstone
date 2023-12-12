<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
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

    // Check if the new amount exceeds the room price
    if ($newAmount > $payment->reservation->room->price_per_night) {
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
    $reservations = Reservation::all();

    return view('dashboard', ['payments' => $payments, 'reservations' => $reservations]);
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


}
