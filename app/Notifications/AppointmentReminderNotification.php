<?php

namespace App\Notifications;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminderNotification extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $appointment_reminder) {
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
        return (new MailMessage)
            ->subject("Booking Appointment Reminder #{$this->appointment_reminder->id}")
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
