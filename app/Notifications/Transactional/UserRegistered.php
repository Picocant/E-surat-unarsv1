<?php

namespace App\Notifications\Transactional;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification
{
    use Queueable;

    public User $registeredUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $registeredUser)
    {
        $this->registeredUser = $registeredUser;
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
        $mailMessage->subject('Registrasi Akun Pengguna Baru');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Registrasi akun pengguna baru telah terjadi pada aplikasi, kami mengirimkan pemberitahuan ini sebagai keamanan karena kamu memiliki hak akses sebagai Kepala Unit Tata Usaha. Berkut ini adalah detail pengguna yang terdaftar.');
        $mailMessage->line('Nama: ' . $this->registeredUser->name);
        $mailMessage->line('Email: ' . $this->registeredUser->email);
        $mailMessage->line('Mendaftar pada: ' . $this->registeredUser->created_at);
        $mailMessage->line('Jika kamu merasa ini adalah kesalahan, segera masuk ke aplikasi untuk melakukan pemeriksaan');
        $mailMessage->action('Buka Aplikasi', route('home.index'));

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Registrasi Akun Pengguna Baru Telah Dilakukan',
            'message' => $this->registeredUser->name . ' dengan email ' . $this->registeredUser->email . ' telah mendaftarkan akun ke aplikasi.'
        ];
    }
}
