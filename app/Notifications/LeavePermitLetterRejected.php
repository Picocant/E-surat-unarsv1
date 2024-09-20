<?php

namespace App\Notifications;

use App\Models\LeavePermitLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeavePermitLetterRejected extends Notification
{
    use Queueable;

    public LeavePermitLetter $leavePermitLetter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(LeavePermitLetter $leavePermitLetter)
    {
        $this->leavePermitLetter = $leavePermitLetter;
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

    public function toMail($notifiable)
    {
        $mailMessage = new MailMessage;
        $mailMessage->subject('Surat Izin Cuti Ditolak');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Kami ingin menginformasikan bahwa surat izin cuti untuk anda telah ditolak.');
        $mailMessage->line('Catatan Penolakan: ' . $this->leavePermitLetter->letter->note);
        $mailMessage->action('Lihat Surat', route('my.leave-permit-letter.index'));

        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Surat Izin Cuti Ditolak',
            'message' => 'Kami ingin menginformasikan bahwa surat izin cuti untuk anda telah ditolak dengan catatan: ' . $this->leavePermitLetter->letter->note
        ];
    }
}
