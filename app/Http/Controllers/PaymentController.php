<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class PaymentController extends Controller {
    public function processPayment(Request $request) {
        $missingKeys = [];

        // Check for required keys
        if (!$request->has('appointmentId')) {
            $missingKeys[] = 'appointmentId';
        }
        if (!$request->has('amount')) {
            $missingKeys[] = 'amount';
        }

        // If there are missing keys, return a JSON response
        if (!empty($missingKeys)) {
            return response()->json([
                'message' => 'Missing required fields.',
                'missing_keys' => $missingKeys,
            ], 400); // 400 Bad Request
        }

        $request->validate([
            'appointmentId' => 'required|exists:appointments,id',
            'amount' => 'required|numeric',
        ]);

        // Find the appointment
        $appointment = Appointment::find($request->appointmentId);


        // Simulate payment process
        if ($request->amount > 0) {
            // Update payment status to paid
            $appointment->payment_status = 'paid';
            $appointment->save();

            return response()->json([
                'message' => 'Payment processed successfully.',
                'appointment' => $appointment,
            ], 200);
        }

        return response()->json(['message' => 'Payment failed.'], 400);
    }
}
