<?php

namespace App\Notifications\Transactional;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserDeleted extends Notification
{
    use Queueable;

    public User $deletedUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $deletedUser)
    {
        $this->deletedUser = $deletedUser;
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
        $mailMessage->subject('Akun Pengguna Telah Dihapus');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Akun pengguna telah dihapus dari aplikasi, kami mengirimkan pemberitahuan ini sebagai keamanan karena kamu memiliki hak akses sebagai Kepala Unit Tata Usaha. Berkut ini adalah detail pengguna yang dihapus.');
        $mailMessage->line('Nama: ' . $this->deletedUser->name);
        $mailMessage->line('Email: ' . $this->deletedUser->email);
        $mailMessage->line('Jika kamu merasa ini adalah kesalahan, segera masuk ke aplikasi untuk melakukan pemeriksaan');
        $mailMessage->action('Buka Aplikasi', route('user.index'));

        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Akun Pengguna Telah Dihapus',
            'message' => $this->deletedUser->name . ' dengan email ' . $this->deletedUser->email . ' telah dihapus dari aplikasi.'
        ];
    }
}
