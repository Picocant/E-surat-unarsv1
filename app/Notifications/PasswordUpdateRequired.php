<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordUpdateRequired extends Notification
{
    use Queueable;

    public string $randomPassword;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $randomPassword)
    {
        $this->randomPassword = $randomPassword;
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
        $mailMessage->subject('Update Kata Sandi Diperlukan - Akun Berhasil Dibuat');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Selamat datang di Aplikasi Pengolahan Surat dan Pengarsipan Dokumen - ' . config('app.name'));
        $mailMessage->line('Akun anda berhasil dibuat. Berikut ini kami sertakan kredensial yang dapat anda gunakan untuk login ke aplikasi.');
        $mailMessage->line('Login: ' . $notifiable->email);
        $mailMessage->line('Kata Sandi: ' . $this->randomPassword);
        $mailMessage->line('Demi keamanan, harap segera perbarui kata sandi default anda.');
        $mailMessage->action('Perbarui Kata Sandi', route('account.index'));

        return $mailMessage;
    }
}
