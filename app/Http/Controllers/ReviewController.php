<?php

namespace App\Http\Controllers;


use App\Models\Room;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function showReviewPopup()
    {
        return view('review');
    }

    public function submitReview(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'room_name' => 'required',
            'room_comment' => 'required',
            'rating' => 'required|numeric|between:1,5',
            'comment' => 'required',
        ]);
    
        $user = User::where('email', $request->input('email'))->first();
    
        if ($user) {
            $review = new Review([
                'user_id' => $user->id, 
                'email' => $request->input('email'),
                'room_name' => $request->input('room_name'),
                'room_comment' => $request->input('room_comment'),
                'rating' => $request->input('rating'),
                'comment' => $request->input('comment'),
            ]);
    
            $review->save();
    
            return response()->json(['message' => 'Review submitted successfully']);
        } else {
            return response()->json(['error' => 'Email not found'], 404);
        }
    }
    
    public function showReviewForm()
    {
        $rooms = Room::pluck('room_name');
        
        return view('review', compact('rooms'));
    }


public function showAllReviews()
{
    $reviews = Review::with('user')->get();
    return view('allreviews', ['reviews' => $reviews]);
}

public function showAllReviewsForRoom($room_name)
{
    // Fetch reviews for the specified room name
    $reviews = Review::with('user')
        ->where('room_name', $room_name)
        ->get();

    // Pass the room reviews to the "moreinfo" view
    return view('more_info', ['reviews' => $reviews]);
}

    
}
