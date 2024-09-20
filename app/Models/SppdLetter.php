<?php

namespace App\Models;

use App\Traits\Letterable;
use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppdLetter extends Model
{
    use HasFactory, UUIDPrimaryKey, Letterable;

    protected $fillable = [
        'from_user_id',
        'destination',
        'budget',
        'start_date',
        'end_date',
        'purpose'
    ];

    protected $casts = [
        'budged' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function recipients()
    {
        return $this->hasMany(SppdLetterRecipient::class);
    }
}
