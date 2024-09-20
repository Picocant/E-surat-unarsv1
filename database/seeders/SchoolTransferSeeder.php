<?php

namespace Database\Seeders;

use App\Models\Letter;
use App\Models\SchoolTransferLetter;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolTransferSeeder extends Seeder
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
            $schoolTransferLetter = new SchoolTransferLetter();
            $schoolTransferLetter->student_id = $student->id;
            $schoolTransferLetter->new_school = 'SDN 2 Bumi Indah';
            $schoolTransferLetter->reason = 'Mengikuti lokasi orang tua bekerja';
            $schoolTransferLetter->save();
            $schoolTransferLetter->letter()->save(new Letter([
                'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi',
            ]));
        }
    }
}
