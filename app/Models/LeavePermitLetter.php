<?php

namespace App\Models;

use App\Traits\Letterable;
use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeavePermitLetter extends Model
{
    use HasFactory, UUIDPrimaryKey, Letterable;

    protected $fillable = [
        'user_id',
        'regarding',
        'attachment',
        'reason',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
