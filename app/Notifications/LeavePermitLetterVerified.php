<?php

namespace App\Notifications;

use App\Models\LeavePermitLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeavePermitLetterVerified extends Notification
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
        $mailMessage->subject('Surat Izin Cuti');
        $mailMessage->greeting('Halo ' . $notifiable->name);
        $mailMessage->line('Kami ingin menginformasikan bahwa surat izin cuti untuk anda telah selesai diverifikasi dan siap untuk di cetak.');
        $mailMessage->line('Nomor Surat: ' . $this->leavePermitLetter->letter->letter_number);
        $mailMessage->action('Lihat Surat', route('my.leave-permit-letter.index'));

        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Surat Izin Cuti',
            'message' => 'Kami ingin menginformasikan bahwa surat izin cuti untuk anda telah selesai diverifikasi dengan nomor surat: ' . $this->leavePermitLetter->letter->letter_number . ' dan siap untuk di cetak.'
        ];
    }
}
