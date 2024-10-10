<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Student([
            "name" => "Enteng Luhung Najmudin",
            "student_number" => "9114726969",
            "date_of_bird" => "2010-11-11",
            "gender" => "Laki-laki",
            "address" => "Dk. Orang No. 414, Lubuklinggau 51355, Sulbar",
            "father" => "Adinata Hartaka Maulana",
            "mother" => "Zulaikha Puspasari M.Ak",
            "guardian" => "Ozy Martaka Utama",
            "fakultas" => "Teknik",
            "prodi" => "informatika",
            "status" => "Aktif"
        ]))->save();
        (new Student([
            "name" => "Luthfi Gunawan",
            "student_number" => "8884099663",
            "date_of_bird" => "2010-03-13",
            "gender" => "Laki-laki",
            "address" => "Gg. Kyai Mojo No. 256, Tanjung Pinang 30051, DIY",
            "father" => "Dipa Tampubolon",
            "mother" => "Fitriani Puspita S.Psi",
            "guardian" => "Karya Tampubolon",
            "fakultas" => "Teknik",
            "prodi" => "informatika",
            "status" => "Cuti"
        ]))->save();
        
    }
}
