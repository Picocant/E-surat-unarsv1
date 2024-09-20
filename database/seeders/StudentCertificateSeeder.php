<?php

namespace Database\Seeders;

use App\Models\Archive;
use App\Models\Student;
use App\Models\StudentCertificate;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class StudentCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = (new Factory)->create();

        $students = Student::all();

        foreach ($students as $student) {

            $year = date('Y');

            Storage::copy('placeholder.pdf', 'student-certificates/' . $student->id . '.pdf');
            $doc = new StudentCertificate([
                'student_id' => $student->id,
                'number' => $faker->numerify('DN-15 D #######'),
                'date' => $faker->date(),
                'academic_year' => $year - 1 . '/' . $year,
                'file' => 'student-certificates/' . $student->id . '.pdf',
            ]);
            $doc->save();
            $doc->archive()->save(new Archive());
        }
    }
}
