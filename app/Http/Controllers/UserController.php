<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function showAllUsers()
    {
        $users = User::all();

        return view('dashboard', ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.users')->with('success', 'User deleted successfully');
    }
}
