<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentsDataTable;
use App\Models\Appointment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(AppointmentsDataTable $dataTable) {
        $user = Auth::user();

        // Check if role is 'admin', return all appointments of all users
        if ($user->role === 'admin') {
            $appointments = Appointment::with('user')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        } else {
            // If role is 'patient', only return the patient's appointments
            $appointments = Appointment::with('user')
                ->where('user_id', $user->id)
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }

        return $dataTable->render('appointments.index', [
            'user' => $user,
            'appointments' => $appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $user = Auth::user();

        // Check if request key contains 'name' to process POST request on filtering appointments and return the filtered data on the view.
        if ($request->has('name')) {
            $query = Appointment::query();

            $start = Carbon::parse($request->start)->format('Y-m-d');
            $end = Carbon::parse($request->end)->format('Y-m-d');

            if ($request->filled('name')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->name . '%');
                });
            }

            if ($request->filled('start') && $request->filled('end')) {
                $query->whereBetween('appointment_date', [$start, $end]);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $appointments = $query->with('user')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            return view('appointments.index', ['appointments' => $appointments, 'user' => $user]);
        }

        // Process POST request for creating a new appointment then redirect back to appointments.index.
        request()->validate([
            'description' => ['required', 'min:3'],
            'pet_name' => ['required'],
            'appointment_date' => ['required', 'date', 'after_or_equal:tomorrow'],
            'appointment_type' => ['required']
        ], [
            'appointment_date.after_or_equal' => 'The appointment date must be tomorrow or a future date.'
        ]);

        $appointment_date = Carbon::parse(request('appointment_date'))->format('Y-m-d');

        $appointment = Appointment::create([
            'description' => request('description'),
            'pet_name' => request('pet_name'),
            'appointment_date' => $appointment_date,
            'appointment_type' => request('appointment_type'),
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        $appointment->refresh();

        // Send mail to the patient after booking a new appointment
        $mail = new EmailController();
        $mail->sendBookingConfirmationEmail($user, $appointment);

        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment) {
        $user = Auth::user();

        if ($appointment->user_id !== Auth::user()->id && $user->role !== 'admin') {
            return redirect()->route('appointments.index');
        }

        return view('appointments.show', ['appointment' => $appointment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment) {
        $user = Auth::user();

        if ($appointment->user_id !== Auth::user()->id && $user->role !== 'admin') {
            return redirect()->route('appointments.index');
        }

        return view('appointments.edit', ['appointment' => $appointment, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment) {
        $user = Auth::user();

        // Responsible for cancelling appointments only
        if (count($request->all()) === 1 && $request->has('status')) {
            $appointment->update([
                'status' => $request->input('status'),
            ]);

            $target_user = User::find($appointment->user_id);

            // Send mail to patient to notify that the appointment is 'cancelled'
            $mail = new EmailController();
            $mail->sendStatusChangeEmail($target_user, $appointment);

            return response()->json($appointment);
        }

        // Responsible for updating an appointment based on the form
        if ($user->id === $appointment->user_id || $user->role === 'admin') {
            request()->validate(
                [
                    'description' => ['required', 'min:3'],
                    'pet_name' => ['required'],
                    'appointment_date' => ['required', 'date', 'after_or_equal:tomorrow'],
                    'appointment_type' => ['required'],
                    // 'status' => ['required']
                ],
                [
                    'appointment_date.after_or_equal' => 'The appointment date must be tomorrow or a future date.'
                ]
            );

            $current_status = $appointment->status;
            $appointment_date = Carbon::parse(request('appointment_date'))->format('Y-m-d');

            $appointment->update([
                'description' => request('description'),
                'pet_name' => request('pet_name'),
                'appointment_date' => $appointment_date,
                'appointment_type' => request('appointment_type'),
                'user_id' => $user->role === 'admin' ? $appointment->user_id : $user->id,
                'status' => request('status') ?? $appointment->status,
            ]);

            // Only send mails when the status have changed to a different state
            if ($user->role === 'admin' && $appointment->status !== $current_status) {
                $target_user = User::find($appointment->user_id);

                $mail = new EmailController();
                $mail->sendStatusChangeEmail($target_user, $appointment);
            }

            return redirect()->route('appointments.show', ['appointment' => $appointment]);
        } else {
            if ($user->id !== $appointment->user_id) {
                abort(403, "You don't have permission to edit this resource.");
            }

            if ($user->role !== 'admin') {
                abort(403, "You don't have access rights to edit this resource.");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment) {
        $user = Auth::user();

        if ($user->id != $appointment->user_id && $user->role !== 'admin') {
            abort(403, "You don't have permission to edit this resource.");
        }

        $appointment->delete();
        $appointment->notifications()->delete();
        $appointment->payment()->delete();

        return redirect()->route('appointments.index');
    }

    /**
     * Show the form for payment processing.
     */
    public function payment(Appointment $appointment) {
        $user = $appointment->user;

        return view('appointments.payment', ['appointment' => $appointment, 'user' => $user]);
    }

    public function processPayment(Request $request, Appointment $appointment) {
        request()->validate([
            'phone_number' => ['required', 'numeric'],
            'amount' => ['required', 'numeric']
        ]);

        $payment = Payment::create([
            'user_id' => $appointment->user->id,
            'appointment_id' => $appointment->id,
            'amount' => request('amount'),
            'phone_number' => request('phone_number'),
        ]);

        $appointment->payment_status = 'paid';
        $appointment->save();

        // Send email notification that the appointment has been paid.
        $mail = new EmailController();
        $mail->sendPaymentConfirmation($appointment->user, $appointment);

        return redirect()->route('appointments.payment-success', ['appointment' => $appointment->id]);
    }

    public function processPaymentView($appointment) {
        $target_appointment = Appointment::with('payment')->findOrFail($appointment);
        $user = Auth::user();

        if ($target_appointment->payment_status === 'paid' && $user->id === $target_appointment->user_id) {
            return view('appointments.payment-success', ['appointment' => $target_appointment]);
        } else {
            return redirect()->route('appointments.show', ['appointment' => $appointment]);
        }
    }
}
