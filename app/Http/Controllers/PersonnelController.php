<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Models\Personnel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class PersonnelController extends Controller
{

    public function showlogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (auth::attempt($credentials)) {
                // Authentication passed
                $userId = auth()->id();
                $user = Personnel::find($userId);

                // Ensure $user is defined before using it
                if ($user) {
                    // ddd($user);
                    return redirect()->route('dashboard', ['user_id' => $userId]);

                } else {
                    // Handle the case where $user is not found
                    // This might indicate an issue with user authentication or retrieval
                    return redirect('login')->with('error', 'User not found');
                }
            }

            // Authentication failed
            $errors = [];

            // Check if the email exists in the database
            if (Personnel::where('email', $request->email)->exists()) {
                $errors['password'] = 'The password you entered is incorrect.';
                $request->old('email');
            } else {
                $errors['email'] = 'This email is not registered.';
            }

            return redirect('login')->withInput()->withErrors($errors);
        } catch (AuthenticationException $exception) {
            ddd($exception->getMessage()); // Debug: Display the exception message
            // Handle the exception (e.g., redirect to login page with error message)
        }
    }

    public function logout()
    {
        // Logout the user
        Auth::logout();

        // Flush all sessions
        Session::flush();
        
        // Redirect to the login page
        return redirect('/login');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
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
}
