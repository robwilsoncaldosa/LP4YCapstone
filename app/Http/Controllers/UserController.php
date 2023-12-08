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
}
