<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmationEmail;
use App\Mail\StatusChangeEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller {
    /**
     * Function that sends a booking confirmation email to a patient after creating an appointment.
     * @param mixed $user
     * @param mixed $appointment
     * @return void
     */
    public function sendBookingConfirmationEmail($user, $appointment) {
        $to_email = $user->email;
        $mail_subject = "Booking Appointment Scheduled #{$appointment->id}";

        Mail::to($to_email)->send(new BookingConfirmationEmail($user, $appointment, $mail_subject));
    }

    /**
     * Function that sends a status change email to a patient after modifying the appointment status by an admin.
     * @param mixed $user
     * @param mixed $appointment
     * @return void
     */
    public function sendStatusChangeEmail($user, $appointment) {
        $to_email = $user->email;
        $mail_subject = "Booking Appointment #{$appointment->id} [Status Update]";

        Mail::to($to_email)->send(new StatusChangeEmail($user, $appointment, $mail_subject));
    }
}
