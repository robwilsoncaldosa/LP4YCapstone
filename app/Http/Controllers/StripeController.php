<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StripeController extends Controller
{
    public function session(Request $request)
    {
      // Validation rules
    $rules = [
        'product_name' => 'required|string',
        'check-in' => 'required|date',
        'check-out' => 'required|date|after:check-in', // Ensure check-out is after check-in
    ];

    // Custom error messages
    $messages = [
        'product_name.required' => 'Product name is required.',
        'check-in.required' => 'Check-in date is required.',
        'check-in.date' => 'Check-in date must be a valid date.',
        'check-out.required' => 'Check-out date is required.',
        'check-out.date' => 'Check-out date must be a valid date.',
        'check-out.after' => 'Check-out date must be after the check-in date.',
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

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'PHP',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount' => $total,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
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

        $totalPriceFormatted = number_format($totalPrice, 2, '.', ''); // Format total price
        $remainingTotalFormatted = number_format($remainingTotal, 2, '.', ''); // Format remaining total

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'PHP',
                        'product_data' => [
                            'name' => $productName,
                        ],
                        'unit_amount' => $totalPriceFormatted,
                    ],
                    'quantity' => 1,
                ],
                [
                    'price_data' => [
                        'currency' => 'PHP',
                        'product_data' => [
                            'name' => 'Remaining Total',
                        ],
                        'unit_amount' => $remainingTotalFormatted,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('book'),
        ]);

        return redirect()->away($session->url)->with([
            'totalPrice' => $totalPriceFormatted,
            'remainingTotal' => $remainingTotalFormatted,
        ]);
    }

    public function success()
    {
        return "You have been booked successfully";
    }
}

