<?php

namespace App\Models;

use App\Traits\Letterable;
use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveStudentLetter extends Model
{
    use HasFactory, UUIDPrimaryKey, Letterable;

    protected $fillable = [
        'student_id',
        'purpose',
    ];

    protected $casts = [
        'verified' => 'boolean'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
