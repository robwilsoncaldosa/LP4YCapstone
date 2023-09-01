<?php

namespace App\Http\Controllers;
use App\Mail\ContactFormEmail;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        try {
            // Send the email
            Mail::to($validatedData['email'])->send(new ContactFormEmail($validatedData));
            
            return redirect()->back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send email. Please try again later.');
        }
    }

}
