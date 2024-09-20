<?php

namespace App\Models;

use App\Traits\Letterable;
use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolTransferLetter extends Model
{
    use HasFactory, UUIDPrimaryKey, Letterable;

    protected $fillable = [
        'student_id',
        'new_school',
        'reason',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
