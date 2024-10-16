<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailController;
use App\Models\User;
use Carbon\Carbon;

class AppointmentController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $appointments = Appointment::with('user')
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            return view('appointments.index', ['appointments' => $appointments, 'user' => $user]);
        }

        $appointments = Appointment::with('user')
            ->where('user_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('appointments.index', ['appointments' => $appointments, 'user' => $user]);
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
            'appointment_date' => ['required'],
            'appointment_type' => ['required']
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

        $mail = new EmailController();
        $mail->sendBookingConfirmationEmail($user, $appointment);

        return redirect()->route('appointments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment) {
        return view('appointments.show', ['appointment' => $appointment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment) {
        $user = Auth::user();
        return view('appointments.edit', ['appointment' => $appointment, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment) {
        $user = Auth::user();

        if (count($request->all()) === 1 && $request->has('status')) {
            // Only update the status
            $appointment->update([
                'status' => $request->input('status'),
            ]);

            $target_user = User::find($appointment->user_id);

            $mail = new EmailController();
            $mail->sendStatusChangeEmail($target_user, $appointment);

            return response()->json($appointment);
        }

        if ($user->id === $appointment->user_id || $user->role === 'admin') {
            request()->validate([
                'description' => ['required', 'min:3'],
                'pet_name' => ['required'],
                'appointment_date' => ['required'],
                'appointment_type' => ['required'],
                // 'status' => ['required']
            ]);

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

        return redirect()->route('appointments.index');
    }
}
