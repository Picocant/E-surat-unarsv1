<?php

namespace App\Models;

use App\Traits\Letterable;
use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PindahProdi extends Model
{
    
    use HasFactory, UUIDPrimaryKey, Letterable;

    protected $fillable = [
        'student_id',
        'new_prodi',
        'reason',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
