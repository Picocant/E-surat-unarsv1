<?php

namespace App\Notifications\Transactional;

use App\Models\ActiveStudentLetter;
use App\Models\LeavePermitLetter;
use App\Models\SchoolTransferLetter;
use App\Models\SppdLetter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LetterVerified extends Notification
{
    use Queueable;

    public $model;
    public $letter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model, $letter)
    {
        $this->model = $model;
        $this->letter = $letter;
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
        $mailMessage->subject('Surat Telah Diverifikasi');
        $mailMessage->greeting('Halo ' . $notifiable->name);

        switch ($this->model) {
            case ActiveStudentLetter::class:
                $mailMessage->line('Surat keterangan siswa aktif telah diverifikasi dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role);
                $mailMessage->line('Nama Siswa: ' . $this->letter->student->name);
                $mailMessage->line('Maksud Pembuatan Surat: ' . $this->letter->purpose);
                $mailMessage->line('Dibuat: ' . $this->letter->created_at);
                $mailMessage->action('Lihat Surat', route('active-student-letter.show', ['activeStudentLetter' => $this->letter]));
                break;

            case SchoolTransferLetter::class:
                $mailMessage->line('Surat keterangan pindah sekolah telah diverifikasi dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role);
                $mailMessage->line('Nama Siswa: ' . $this->letter->student->name);
                $mailMessage->line('Tujuan Sekolah Baru: ' . $this->letter->new_school);
                $mailMessage->line('Alasan Pindah: ' . $this->letter->reason);
                $mailMessage->line('Dibuat: ' . $this->letter->created_at);
                $mailMessage->action('Lihat Surat', route('school-transfer-letter.show', ['schoolTransferLetter' => $this->letter]));
                break;

            case SppdLetter::class:
                $mailMessage->line('Surat perintah perjalanan dinas telah diverifikasi dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role);
                $mailMessage->line('Nomor Surat: ' . $this->letter->letter->letter_number);
                $mailMessage->action('Lihat Surat', route('sppd-letter.show', ['sppdLetter' => $this->letter]));
                break;

            case LeavePermitLetter::class:
                $mailMessage->line('Surat izin cuti telah diverifikasi dan siap untuk dicetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role);
                $mailMessage->line('Nomor Surat: ' . $this->letter->letter->letter_number);
                $mailMessage->line('Nama: ' . $this->letter->user->name);
                $mailMessage->line('NIP: ' . ($this->letter->user->nip) ? $this->letter->user->nip : '');
                $mailMessage->line('Tanggal Mulai Cuti: ' . $this->letter->start_date->isoFormat('DD MMMM Y'));
                $mailMessage->line('Tanggal Selesai Cuti: ' . $this->letter->end_date->isoFormat('DD MMMM Y'));
                $mailMessage->line('Alasan Cuti: ' . $this->letter->reason);
                $mailMessage->action('Lihat Surat', route('leave-permit-letter.show', ['leavePermitLetter' => $this->letter]));
                break;

            default:
                # code...
                break;
        }
        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        $message = '';

        switch ($this->model) {
            case ActiveStudentLetter::class:
                $message = 'Surat keterangan siswa aktif telah diverifikasi dengan nomor surat ' . $this->letter->letter->letter_number . ' dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role;
                break;

            case SchoolTransferLetter::class:
                $message = 'Surat keterangan pindah sekolah telah diverifikasi dengan nomor surat ' . $this->letter->letter->letter_number . ' dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role;
                break;

            case SppdLetter::class:
                $message = 'Surat perintah perjalanan dinas telah diverifikasi dengan nomor surat ' . $this->letter->letter->letter_number . ' dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role;
                break;

            case LeavePermitLetter::class:
                $message = 'Surat izin cuti telah diverifikasi dengan nomor surat ' . $this->letter->letter->letter_number . ' dan siap untuk di cetak. Kami mengirimkan pemberitahuan ini karena anda memiliki hak akses sebagai ' . $notifiable->role;
                break;

            default:
                # code...
                break;
        }

        return [
            'title' => 'Surat Telah Diverifikasi',
            'message' => $message
        ];
    }
}
