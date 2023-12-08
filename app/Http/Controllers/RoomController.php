<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showBookingView()
    {
        $rooms = Room::all();
        return view('book',compact('rooms'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function moreinfo(string $name)
    {
        $room = Room::where('room_name', $name)->firstOrFail(); // Retrieve the room by name

        return view('more_info', compact('room')); // Pass the room data to the view

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function showAllRooms()
    {
        $rooms = Room::all();
        // return view('dashboard_reservation', ['reservations' => $reservations]);
        return view('dashboard', ['rooms' => $rooms]);
    }

      public function showRoomStatus()
    {
        

$roomStatuses = DB::table('rooms')
->select('rooms.room_name', DB::raw("CASE WHEN reservations.checked_out_at >= NOW() THEN CONCAT('Occupied until ', reservations.checked_out_at) ELSE 'Available' END as status"))
->leftJoin('reservations', function ($join) {
    $join->on('rooms.id', '=', 'reservations.room_id')
        ->where('reservations.checked_out_at', '=', DB::raw('(SELECT MAX(checked_out_at) FROM reservations WHERE room_id = rooms.id)'));
})
->get();

return view('dashboard', ['roomStatuses' => $roomStatuses]);

}
}
