<?php

namespace App\Notifications;

use App\Models\Notification as ModelsNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminderNotification extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $appointment_reminder, protected $user) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        $subject = "Booking Appointment Reminder #{$this->appointment_reminder->id}";

        ModelsNotification::create([
            "user_id" => $this->user->id,
            "appointment_id" => $this->appointment_reminder->id,
            "email" => $this->user->email,
            "subject" => $subject,
        ]);

        return (new MailMessage)
            ->subject($subject)
            ->view('mail.appointment-reminder', [
                'appointment' => $this->appointment_reminder
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'title' => $this->appointment_reminder['title'],
            'date' => $this->appointment_reminder['date'],
        ];
    }
}
