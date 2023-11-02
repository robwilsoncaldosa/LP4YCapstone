<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Models\Personnel;

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

            if (Auth::attempt($credentials)) {
                $user = Auth::user(); // Get the authenticated user
                // Authentication passed
                return redirect()->intended('/dashboard')
                    ->with([
                        'user' => $user,
                    ]); // Pass user data to the next request
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
        Auth::logout();
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
