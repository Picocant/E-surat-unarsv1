<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingLetterDisposition extends Model
{
    use HasFactory, UUIDPrimaryKey;

    const TYPE_NORMAL = 'Biasa';
    const TYPE_IMPORTANT = 'Penting';
    const TYPE_IMMEDIATELY = 'Segera';
    const TYPE_SECRET = 'Rahasia';

    const TYPES = [
        self::TYPE_NORMAL,
        self::TYPE_IMPORTANT,
        self::TYPE_IMMEDIATELY,
        self::TYPE_SECRET,
    ];

    protected $fillable = [
        'incoming_Letter_id',
        'to',
        'type',
        'message',
    ];

    public function incoming_letter()
    {
        return $this->belongsTo(IncomingLetter::class);
    }

    public function signature()
    {
        return $this->morphOne(Signature::class, 'signaturable');
    }
}
