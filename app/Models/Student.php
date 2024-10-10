<?php

namespace App\Models;

use App\Traits\UUIDPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, UUIDPrimaryKey;

    const GENDER_MALE = 'Laki-laki';
    const GENDER_FEMALE = 'Perempuan';
    const STATUS_AKTIF = 'Aktif';
    const STATUS_CUTI = 'Cuti';
    const STATUS_NONAKTIF = 'Tidak Aktif';
    const STATUS_ALUMNI = 'Alumni';
    const GENDERS = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
    ];
    Const STATUS =[
        self::STATUS_AKTIF,
        self::STATUS_CUTI,
        self::STATUS_NONAKTIF,
        self::STATUS_ALUMNI,
        
    ] ;

    protected $fillable =  [
        'name',
        'student_number',
        'date_of_bird',
        'gender',
        'address',
        'father',
        'mother',
        'guardian',
        'fakultas',
        'prodi',
        'status',
    ];

    protected $casts = [
        'date_of_bird' => 'date'
    ];

    public function active_student_letters()
    {
        return $this->hasMany(ActiveStudentLetter::class);
    }

    public function student_certificate()
    {
        return $this->hasOne(StudentCertificate::class);
    }

    public function school_transfer_letters()
    {
        return $this->hasMany(SchoolTransferLetter::class);
    }
    
    public function pindah_prodi()
    {
        return $this->hasMany(PindahProdi::class);
    }

}
