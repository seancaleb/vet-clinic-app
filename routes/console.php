<?php

use App\Models\Appointment;
use App\Notifications\AppointmentReminderNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Command for sending manual reminder mails to users for their appointments which will notify them if their schedule is less than 24 hours away
Artisan::command('send:reminders', function () {
    $this->comment('Sending reminders...');

    // Get all appointments happening 24 hours from now
    $appointments = Appointment::whereBetween('appointment_date', [
        now()->addDay()->startOfDay(),
        now()->addDay()->endOfDay()
    ])->get();

    // Loop through the appointments and notify each user
    foreach ($appointments as $appointment) {
        $user = $appointment->user;

        // Check if appointment status is 'confirmed'
        $is_appointment_confirmed = $appointment->status === 'confirmed';

        // Send the notification to the user
        if ($user && $user->email && $is_appointment_confirmed) {
            $user->notify(new AppointmentReminderNotification($appointment));
        }
    }

    $this->info('Reminder emails sent successfully.');
})->purpose('Send appointment reminder emails 24 hours before the appointment.');
