<?php

namespace Database\Seeders;

use App\Models\ActiveStudentLetter;
use App\Models\Letter;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActiveStudentLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $activeStudentLetter = new ActiveStudentLetter;
            $activeStudentLetter->student_id = $student->id;
            $activeStudentLetter->purpose = 'Persyaratan mendaftar beasiswa prestasi';
            $activeStudentLetter->save();
            $activeStudentLetter->letter()->save(new Letter([
                'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi',
            ]));
        }
    }
}
