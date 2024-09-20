<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetedNotice extends Notification
{
    use Queueable;

    public string $newPassword;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
        $mailMessage->subject('Update Kata Sandi Diperlukan - Kata Sandi Direset');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Kata sandi akun anda telah direset oleh administrator. Berikut ini kami sertakan kredensial baru yang dapat anda gunakan untuk login ke aplikasi.');
        $mailMessage->line('Login: ' . $notifiable->email);
        $mailMessage->line('Kata Sandi: ' . $this->newPassword);
        $mailMessage->line('Demi keamanan, harap segera perbarui kata sandi default anda.');
        $mailMessage->action('Perbarui Kata Sandi', route('account.index'));

        return $mailMessage;
    }
}
