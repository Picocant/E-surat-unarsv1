<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCertificate extends Model
{
    use HasFactory, UUIDPrimaryKey;

    protected $fillable = [
        'student_id',
        'number',
        'date',
        'academic_year',
        'file'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function archive()
    {
        return $this->morphOne(Archive::class, 'archivable');
    }
}
