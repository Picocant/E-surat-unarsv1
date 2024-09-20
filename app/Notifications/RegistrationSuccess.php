<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationSuccess extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailMessage = new MailMessage;
        $mailMessage->subject('Registrasi Akun Berhasil');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Selamat datang di Aplikasi Pengolahan Surat dan Pengarsipan Dokumen Sekolah - .' . config('app.name'));

        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Registrasi berhasil',
            'message' => 'Halo ' . $notifiable->name . ', registrasi akun anda telah berhasil. Selamat datang di Aplikasi Pengolahan Surat dan Pengarsipan Dokumen Sekolah - '. config('app.name'),
        ];
    }
}
