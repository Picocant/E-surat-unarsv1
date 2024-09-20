<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingLetter extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'incoming_letter_category_id',
        'letter_number',
        'regarding',
        'attachment',
        'from',
        'to',
        'date',
        'file',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function incoming_letter_category()
    {
        return $this->belongsTo(IncomingLetterCategory::class);
    }

    public function incoming_letter_disposition()
    {
        return $this->hasOne(IncomingLetterDisposition::class);
    }
}
