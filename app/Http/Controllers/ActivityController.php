<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $activities = Activity::all();
        $reservations = Reservation::all();

        return view('dashboard', ['activities' => $activities, 'reservations' => $reservations]);
    }


    // Other methods remain unchanged

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('dashboard.activities')->with('success', 'Payment deleted successfully.');



    }
}
