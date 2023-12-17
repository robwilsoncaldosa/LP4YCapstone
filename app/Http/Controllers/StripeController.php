<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Payment;
use Carbon\Carbon;
use Redirect;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        // Validation rules
        $rules = [
            'product_name' => 'required|string',
            'check-in' => 'required|date',
            'check-out' => 'required|date|after:check-in',
            'name' => 'required|string',
            'email' => 'required|email',
        ];

        // Custom error messages
        $messages = [
            'product_name.required' => 'Product name is required.',
            'check-in.required' => 'Check-in date is required.',
            'check-in.date' => 'Check-in date must be a valid date.',
            'check-out.required' => 'Check-out date is required.',
            'check-out.date' => 'Check-out date must be a valid date.',
            'check-out.after' => 'Check-out date must be after the check-in date.',
            'name.required' => 'Provide Full Name',
            'email.required' => 'Provide Valid Email'
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $productname = $request->get('product_name');
        $totalprice = $request->get('total');

        $two0 = "00";
        $total = "$totalprice$two0";

        // Get customer email from the input
        $userEmail = $request->get('email');

        // Create a customer with the provided email
        $customer = \Stripe\Customer::create([
            'email' => $userEmail,
        ]);

        $session = \Stripe\Checkout\Session::create([
            'customer' => $customer->id,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'PHP',
                        'product_data' => [
                            'name' => $productname,
                        ],
                        'unit_amount' => $total,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success', [
                'product_name' => $productname,
                'total' => $totalprice,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'room_id' => $request->get('room_id'),
                'check-in' => $request->get('check-in'),
                'check-out' => $request->get('check-out'),
                'downpayment' => $request->get('downpayment')

                // Add other data as needed
            ]),
            'cancel_url' => route('book'),
        ]);

        return redirect()->away($session->url);


    }

    public function createDownpaymentSession(Request $request)
    {
        // Validation rules
        $rules = [
            'product_name' => 'required|string',
            'check-in' => 'required|date',
            'check-out' => 'required|date|after:check-in', // Ensure check-out is after check-in
            'downpayment' => 'required|numeric', // Added validation for downpayment
            'name' => 'required|string',
            'email' => 'required|email',
        ];

        // Custom error messages
        $messages = [
            'product_name.required' => 'Product name is required.',
            'check-in.required' => 'Check-in date is required.',
            'check-in.date' => 'Check-in date must be a valid date.',
            'check-out.required' => 'Check-out date is required.',
            'check-out.date' => 'Check-out date must be a valid date.',
            'check-out.after' => 'Check-out date must be after the check-in date.',
            'downpayment.required' => 'Downpayment amount is required.',
            'downpayment.numeric' => 'Downpayment must be a numeric value.',
            'name.required' => 'Provide Full Name',
            'email.required' => 'Provide Valid Email'
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        $productName = $request->input('product_name');
        $totalPrice = $request->input('total');
        $downpayment = $request->input('downpayment');


        // Calculate the remaining total
        $remainingTotal = $totalPrice - $downpayment;

        // Convert the formatted amounts to cents (integer)
        $totalPriceInCents = intval($totalPrice * 100);
        $downpaymentInCents = intval($downpayment * 100);
        $remainingTotalInCents = intval($remainingTotal * 100);

        // Get customer email from the input
        $userEmail = $request->get('email');

        // Create a customer with the provided email
        $customer = \Stripe\Customer::create([
            'email' => $userEmail,
        ]);

        $session = \Stripe\Checkout\Session::create([
            'customer' => $customer->id,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'PHP',
                        'product_data' => [
                            'name' => "Downpayment of Room {$productName}",
                        ],
                        'unit_amount' => $downpaymentInCents, // Set the unit_amount to the downpayment
                    ],
                    'quantity' => 1,
                ],

            ],
            'mode' => 'payment',
            'success_url' => route('success', [
                'product_name' => $productName,
                'total' => $totalPrice,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone2'),
                'room_id' => $request->get('room_id'),
                'check-in' => $request->get('check-in'),
                'check-out' => $request->get('check-out'),
                'downpayment' => $request->get('downpayment')

                // Add other data as needed
            ]),
            'cancel_url' => route('book'),
        ]);

        return redirect()->away($session->url);

    }


    public function success(Request $request)
    {
        // Access the request data here
        $productName = $request->get('product_name');
        $totalPrice = $request->get('total');
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $room_id = $request->get('room_id');
        $check_in = $request->get('check-in');
        $check_out = $request->get('check-out');
        $downpayment = $request->get('downpayment');

        // If downpayment is null or not accessible, set it to 0
        $downpayment = $downpayment ?? 0;

        // Create a new User model instance
        $user = new User();

        // Set the attributes for the User
        $user->name = $name;
        $user->email = $email;
        $user->contact_number = $phone;

        // Save the user to the database
        $user->save();

        // Retrieve the ID of the newly created user
        $userId = $user->id;

        // Create a new Reservation model instance
        $reservation = new Reservation();

        // Set the attributes for the Reservation
        $reservation->user_id = $userId;
        $reservation->room_id = $room_id;
        $reservation->check_in_date = Carbon::parse($check_in)->toDateString(); // Format date using Carbon
        $reservation->check_in_time = null; // Set check_in_time to null
        $reservation->check_out_date = Carbon::parse($check_out)->toDateString(); // Format date using Carbon
        $reservation->check_out_time = null; // Set check_out_time to null

        // Save the reservation to the database
        $reservation->save();

        // Retrieve the ID of the newly created reservation
        $reservationId = $reservation->id;

        // Calculate the remaining total based on downpayment
        $remainingTotal = $totalPrice - $downpayment;

        // If downpayment is not provided, set remaining total equal to total price
        if ($downpayment === 0) {
            $remainingTotal = 0;
            $downpayment = $totalPrice;
        }

        // Create a new Payment model instance
        $payment = new Payment();

        // Set the attributes for the Payment
        $payment->reservation_id = $reservationId;
        $payment->remaining_total = $remainingTotal;
        $payment->amount = $downpayment;
        $payment->payment_method = 'online payment';

        // Save the payment to the database
        $payment->save();
        // Build a custom success message
           // Build a custom success message with customer-centric details
    $successMessage = 'Booking successful! We appreciate your trust, ' . $name . '.';
    $successMessage .= ' Your reservation for ' . $productName . ' has been confirmed.';

    // Include a message for further assistance via website contact section and messenger
    $contactMessage = 'If you have any questions or need further assistance, feel free to reach out to us. ';
    $contactMessage .= 'You can contact us through our <a href="/contact">contact section</a> on the website or by clicking the messenger icon in the lower right corner.';

    // Redirect to the home route with the enhanced success message
    return Redirect::to('/')
        ->with('success', $successMessage)
        ->with('contactMessage', $contactMessage);
    }
}

