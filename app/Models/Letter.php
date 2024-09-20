<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Letter extends Model
{
    use HasFactory, UUIDPrimaryKey;

    const STATUS_WAITING = 'Menunggu Verifikasi';
    const STATUS_VERIFIED = 'Diverifikasi';
    const STATUS_REJECTED = 'Ditolak';

    const STATUSES = [
        self::STATUS_WAITING,
        self::STATUS_VERIFIED,
        self::STATUS_REJECTED
    ];

    protected $fillable = [
        'letterable_type',
        'letterable_id',
        'serial_number',
        'letter_number',
        'verified',
        'status',
        'note',
    ];

    public function letterable()
    {
        return $this->morphTo();
    }

    public function signature()
    {
        return $this->morphOne(Signature::class, 'signaturable');
    }

    public function verify($note = 'Surat telah selesai diverifikasi dan sudah bisa dicetak', $details = [])
    {
        if ($this->verified) return;

        $serialNumber = $this->getSerialNumber();
        $letterNumber = $this->createLetterNumber($serialNumber);

        $this->serial_number = $serialNumber;
        $this->letter_number = $letterNumber;
        $this->verified = true;
        $this->status = self::STATUS_VERIFIED;
        $this->note = $note;
        $this->save();

        $this->signature()->save(new Signature([
            'payload' => Signature::buildPayload(array_merge(['Nomor Surat' => $letterNumber], $details))
        ]));
    }

    public function reject($note = 'Surat telah ditolak, silahkan perbaiki data atau mengajukan ulang')
    {
        $this->verified = false;
        $this->status = self::STATUS_REJECTED;
        $this->note = $note;
        $this->save();
    }

    public function verified()
    {
        return $this->status === self::STATUS_VERIFIED;
    }

    public function rejected()
    {
        return $this->status === self::STATUS_REJECTED;
    }

    public function waiting()
    {
        return $this->status === self::STATUS_WAITING;
    }

    private function getSerialNumber()
    {
        $latest = Letter::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->max('serial_number');

        return $latest + 1;
    }

    private function createLetterNumber($serialNumber)
    {
        $classificationCode = $this->getClassificationCode($this->letterable_type);
        $month = $this->getMonth();
        $year = $this->created_at->format('Y');

        $serialNumber = substr(str_repeat(0, 3) . $serialNumber, -3);

        return '421.2/' . $serialNumber . '/' . $classificationCode . '/UNARS/' . $month . '/' . $year;
    }

    private function getClassificationCode($letterableType)
    {
        switch ($letterableType) {
            case ActiveStudentLetter::class:
                return 'SKA';
            case SchoolTransferLetter::class:
                return 'SKP';
            case PindahProdi::class:
                return 'SKPP';
            case SppdLetter::class:
                return 'SPPD';
            case LeavePermitLetter::class:
                return 'SIC';
            default:
                return '';
        }
    }

    private function getMonth()
    {
        switch ($this->created_at->format('m')) {
            case '01':
                return 'I';
            case '02':
                return 'II';
            case '03':
                return 'III';
            case '04':
                return 'IV';
            case '05':
                return 'V';
            case '06':
                return 'VI';
            case '07':
                return 'VII';
            case '08':
                return 'VIII';
            case '09':
                return 'IX';
            case '10':
                return 'X';
            case '11':
                return 'XI';
            case '12':
                return 'XII';
            default:
                return '';
        }
    }
}
