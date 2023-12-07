<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
       // Method to display the pop-up form
       public function showReviewPopup()
       {
           return view('reviews'); // Replace with the actual Blade view path
       }
   
      public function submitReview(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'rating' => 'required|numeric|between:1,5',
              'comment' => 'required',
          ]);
      
          // Save the review to the database (use the Review model)
          $review = new Review([
              'name' => $request->input('name'),
              'rating' => $request->input('rating'),
              'comment' => $request->input('comment'),
          ]);
          $review->save();
      
          return response()->json(['message' => 'Review submitted successfully']);
      }
  
      public function getGuestReviews()
      {
          $reviews = Review::all(); // Fetch all reviews from the database
      
          return view('app', ['reviews' => $reviews]);
      }
}