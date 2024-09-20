<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingLetterCategory extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'name'
    ];

    public function incoming_letters()
    {
        return $this->hasMany(IncomingLetter::class);
    }
}
