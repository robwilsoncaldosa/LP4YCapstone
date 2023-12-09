<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Models\Personnel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Models\Reservation;
use Carbon\Carbon;
use App\Mail\UserAdded;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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

            if (auth()->attempt($credentials)) {
                // Authentication passed
                $user = auth()->user(); // Retrieve the authenticated user

                // Store user data in the session
                session(['user' => $user]);


                $totalBookings = Reservation::count();
    
                // Calculate new clients this month
                $newClientsThisMonth = Reservation::whereMonth('created_at', '=', Carbon::now()->month)->count();
                
                // Calculate returning clients
                $returningClients = Reservation::distinct('user_id')
                    ->where('check_in_date', '<', Carbon::now()) // Assuming check_in_date is your timestamp for reservations
                    ->count();

                    return redirect()->route('dashboard.home')
                    ->with([
                        'user' => $user,
                        'totalBookings' => $totalBookings,
                        'newClientsThisMonth' => $newClientsThisMonth,
                        'returningClients' => $returningClients,
            
                    ]);
                // return redirect()->route('dashboard');
            } else {
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
            }
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
    public function viewPersonnels()
    {
        $personnels = Personnel::all();
        return view('dashboard', ['personnels' => $personnels]);
    }

    
    public function create()
    {
        return view('dashboard.personnel.create');
    }

    /**
     * Store a newly created personnel in the database.
     */
   /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:personnels',
    ]);

    // Create the user with default values
    $user = Personnel::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt('1234'), // Default password set to '1234'
        'role' => 'staff', // Default role set to 'staff'
        'status' => 'active',
    ]);

    // Assuming $user is an instance of Personnel
    $userData = $user->toArray();

    try {
        Mail::to($user->email)->send(new UserAdded($user));
    } catch (\Exception $e) {
        Log::error('Email sending failed: ' . $e->getMessage());
    }

    // Redirect or respond as needed
    return redirect()->route('dashboard.personnel')->with('success', 'User added successfully. Password is set to "1234", and role is set to "staff".');
}


    /**
     * Display the specified personnel.
     */
    public function show($id)
    {
        $personnel = Personnel::findOrFail($id);
        return view('dashboard.personnel.show', compact('personnel'));
    }

    /**
     * Show the form for editing the specified personnel.
     */
    public function edit($id)
    {
        $personnel = Personnel::findOrFail($id);
        return view('dashboard.personnel.edit', compact('personnel'));
    }

    /**
     * Update the specified personnel in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:personnels,email,' . $id,
            // Add other validation rules as needed
        ]);

        // Update the personnel
        $personnel = Personnel::findOrFail($id);
        $personnel->name = $request->input('name');
        $personnel->email = $request->input('email');
        // Update other fields as needed
        $personnel->save();

        return redirect()->route('personnel.index')->with('success', 'Personnel updated successfully.');
    }

    /**
     * Remove the specified personnel from the database.
     */
    public function destroy($id)
    {
        // Find the personnel
        $personnel = Personnel::find($id);

        if (!$personnel) {
            // Handle the case where personnel is not found
            return redirect()->back()->with('error', 'Personnel not found');
        }

        // Delete the personnel
        $personnel->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Personnel deleted successfully');
    }
}
