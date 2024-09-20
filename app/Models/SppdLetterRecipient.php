<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdLetterRecipient extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'sppd_letter_id',
        'user_id',
    ];

    public function sppd_letter()
    {
        return $this->belongsTo(SppdLetter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
