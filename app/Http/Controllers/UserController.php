<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;

class UserController extends Controller
{
    public function showAllUsers()
    {
        $users = User::all();
        $reservations = Reservation::all();

        return view('dashboard', ['users' => $users,'reservations' => $reservations]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.users')->with('success', 'User deleted successfully');
    }
}
