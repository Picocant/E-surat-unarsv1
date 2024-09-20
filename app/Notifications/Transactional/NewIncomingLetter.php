<?php

namespace App\Notifications\Transactional;

use App\Models\IncomingLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewIncomingLetter extends Notification
{
    use Queueable;

    public IncomingLetter $incomingLetter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(IncomingLetter $incomingLetter)
    {
        $this->incomingLetter = $incomingLetter;
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
        $mailMessage->subject('Surat Masuk Baru');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Terdapat surat masuk baru ditambahkan, anda menerima pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role);
        $mailMessage->line('Surat dari: ' . $this->incomingLetter->from);
        $mailMessage->line('Kepada: ' . $this->incomingLetter->to);
        $mailMessage->line('Perihal: ' . $this->incomingLetter->regarding);
        $mailMessage->line('Tanggal: ' . $this->incomingLetter->date->format('d F Y'));
        $mailMessage->action('Lihat Surat', route('incoming-letter.show', ['incomingLetter' => $this->incomingLetter]));
        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Surat Masuk Baru',
            'message' => 'Terdapat surat masuk baru dari ' . $this->incomingLetter->from . ' dengan perihal: ' . $this->incomingLetter->regarding . ' <a class="link-danger" href="' . route('incoming-letter.show', ['incomingLetter' => $this->incomingLetter]) . '">Lihat Surat</a>',
        ];
    }
}
