<?php

namespace Database\Seeders;


use App\Models\Letter;
use App\Models\PindahProdi;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PindahProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     */
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            $pindahProdi = new PindahProdi();
            $pindahProdi->student_id = $student->id;
            $pindahProdi->new_prodi = 'SDN 2 Bumi Indah';
            $pindahProdi->reason = 'Mengikuti lokasi orang tua bekerja';
            $pindahProdi->save();
            $pindahProdi->letter()->save(new Letter([
                'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi',
            ]));
        }
    }
}
