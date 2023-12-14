<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
        return view('book', compact('rooms'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create_room');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'room_name' => 'required|unique:rooms',
            'description' => 'required',
            'accommodates' => 'required|numeric',
            'beds' => 'required|numeric',
            'bed_type' => 'required',
            'amenities' => 'required',
            'price_per_night' => 'required|numeric',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload the image
        $image = $request->file('image_path');
        $originalFilename = $image->getClientOriginalName();
        $filename = pathinfo($originalFilename, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $timestamp = now()->timestamp;
        $uniqueFilename = "{$filename}_{$timestamp}.{$extension}";

        // Specify the absolute path to public/img
        $image->move(public_path('img'), $uniqueFilename);

        // Set the image path for database storage
        $imagePath = "img/{$uniqueFilename}";

        // Create the room
        $room = Room::create([
            'room_name' => $request->input('room_name'),
            'description' => $request->input('description'),
            'accommodates' => $request->input('accommodates'),
            'beds' => $request->input('beds'),
            'bed_type' => $request->input('bed_type'),
            'amenities' => $request->input('amenities'),
            'price_per_night' => $request->input('price_per_night'),
            'image_path' => $imagePath,
        ]);


        // Redirect or respond as needed
        return redirect()->route('dashboard.rooms')->with('success', 'Room added successfully.');
    }

    public function moreinfo(string $name)
    {
        $room = Room::where('room_name', $name)->firstOrFail(); // Retrieve the room by name

        return view('more_info', compact('room')); // Pass the room data to the view

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('dashboard.edit_room', compact('room'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'room_name' => 'required|unique:rooms,room_name,' . $id,
            'description' => 'required',
            'accommodates' => 'required|numeric',
            'beds' => 'required|numeric',
            'bed_type' => 'required',
            'amenities' => 'required',
            'price_per_night' => 'required|numeric',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the room by ID
        $room = Room::findOrFail($id);

        // Update the room
        $room->update($request->all());

        // Redirect or respond as needed
        return redirect()->route('dashboard.rooms')->with('success', 'Room updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the room by ID
        $room = Room::findOrFail($id);

        // Delete the room
        $room->delete();

        // Redirect or respond as needed
        return redirect()->route('dashboard.rooms')->with('success', 'Room deleted successfully.');
    }



    public function showAllRooms()
    {
        $rooms = Room::all();
        $reservations = Reservation::all();
        return view('dashboard', ['rooms' => $rooms,
        'reservations' => $reservations]);
    }

    public function showRoomStatus()
    {

        $reservations = Reservation::all();

        $roomStatuses = DB::table('rooms')
            ->select('rooms.room_name', DB::raw("CASE WHEN reservations.check_out_date >= NOW() THEN CONCAT('Occupied until ', DATE_FORMAT(reservations.check_out_date, '%M %e, %Y at %l:%i %p')) ELSE 'Available' END as status"))
            ->leftJoin('reservations', function ($join) {
                $join->on('rooms.id', '=', 'reservations.room_id')
                    ->where('reservations.check_out_date', '=', DB::raw('(SELECT MAX(check_out_date) FROM reservations WHERE room_id = rooms.id)'));
            })
            ->get();

        return view('dashboard', ['roomStatuses' => $roomStatuses,'reservations' => $reservations]);

    }
}
