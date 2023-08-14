<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
      //ADMIN DASHBOARD LOGIC(TO BE DISCUSS)
    }

    public function showReviews()
    {
        $reviews = Review::all();
        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully.');
    }

    // Methods for Reservations, Users, and Rooms

    public function showReservations()
    {
        $reservations = Reservation::all();
        return view('admin.reservations', compact('reservations'));
    }

    // public function updateReservation(Request $request, $id)
    // {
    //     // To be discuss..
    // }

    public function deleteReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('admin.reservations')->with('success', 'Reservation deleted successfully.');
    }

//WHERE WE MUST PUT THE "STORE RESERVATION FUNCTION"?

}

