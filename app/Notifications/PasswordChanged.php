<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChanged extends Notification
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
        $mailMessage->subject('Kata Sandi Baru Saja Dirubah');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Kami mendeteksi bahwa kata sandi akun anda baru saja dirubah. Abaikan pesan ini jika ini adalah aksi yang anda lakukan.');
        $mailMessage->line('Jika ini bukan anda, harap segera hubungi administrator untuk melakukan pemeriksaan.');

        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Kata sandi telah dirubah',
            'message' => 'Kami mendeteksi bahwa kata sandi akun anda baru saja dirubah.'
        ];
    }
}
