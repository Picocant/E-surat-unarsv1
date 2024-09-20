<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountDeletedNotice extends Notification
{
    use Queueable;

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
        $mailMessage->subject('Akun Anda Telah Dihapus');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Kami mendeteksi bahwa akun anda telah berhasil dihapus dari aplikasi. Anda tidak dapat masuk kembali ke aplikasi menggunakan akun berikut ini:');
        $mailMessage->line('Nama: ' . $notifiable->name);
        $mailMessage->line('Email: ' . $notifiable->email);
        $mailMessage->line('Jika anda merasa ini adalah kesalahan, harap segera laporkan ke pada salah satu administrator berikut:');
        $admins = User::where('role', User::ROLE_KEPALA_TU)->get();
        foreach ($admins as $admin) {
            $mailMessage->line($admin->name . ' - (' . $admin->email . ')');
        }

        return $mailMessage;
    }
}
