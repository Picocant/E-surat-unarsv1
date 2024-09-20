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
        ]))->save();
        (new Student([
            "name" => "Arsipatra Koko Situmorang",
            "student_number" => "9853198575",
            "date_of_bird" => "2010-11-16",
            "gender" => "Laki-laki",
            "address" => "Gg. Labu No. 678, Kediri 27194, Sumut",
            "father" => "Danuja Hakim S.E.I",
            "mother" => "Nabila Aryani",
            "guardian" => "Nabila Astuti S.H.",
        ],))->save();
        (new Student([
            "name" => "Ika Alika Utami",
            "student_number" => "8568027074",
            "date_of_bird" => "2010-06-29",
            "gender" => "Perempuan",
            "address" => "Kpg. HOS. Cjokroaminoto (Pasirkaliki) No. 311, Denpasar 56923, DIY",
            "father" => "Bakijan Pranawa Irawan",
            "mother" => "Suci Ira Puspita S.Kom",
            "guardian" => "Ibun Pradipta",
        ],))->save();
        (new Student([
            "name" => "Ika Purnawati",
            "student_number" => "1029524772",
            "date_of_bird" => "2010-04-12",
            "gender" => "Perempuan",
            "address" => "Ki. Bah Jaya No. 442, Cilegon 73709, NTB",
            "father" => "Daliono Prayitna Kurniawan M.M.",
            "mother" => "Usyi Rahmawati",
            "guardian" => "Indah Wijayanti",
        ],))->save();
        (new Student([
            "name" => "Diana Pia Usada",
            "student_number" => "5580205697",
            "date_of_bird" => "2010-03-13",
            "gender" => "Perempuan",
            "address" => "Dk. Bakin No. 643, Jambi 55414, Sumbar",
            "father" => "Timbul Lasmono Salahudin S.E.",
            "mother" => "Zizi Usada",
            "guardian" => "Clara Oktaviani",
        ],))->save();
        (new Student([
            "name" => "Michelle Victoria Usamah",
            "student_number" => "2933379134",
            "date_of_bird" => "2010-02-02",
            "gender" => "Perempuan",
            "address" => "Jln. Siliwangi No. 697, Yogyakarta 77586, Banten",
            "father" => "Bagas Kuswoyo",
            "mother" => "Clara Yolanda",
            "guardian" => "Suci Maryati",
        ],))->save();
        (new Student([
            "name" => "Dipa Habibi",
            "student_number" => "8427555759",
            "date_of_bird" => "2010-02-03",
            "gender" => "Laki-laki",
            "address" => "Ds. Ekonomi No. 169, Tegal 66613, Sumut",
            "father" => "Gambira Maryadi",
            "mother" => "Mutia Aisyah Riyanti",
            "guardian" => "Rika Rahimah",
        ],))->save();
        (new Student([
            "name" => "Zalindra Usada",
            "student_number" => "3049489603",
            "date_of_bird" => "2010-04-12",
            "gender" => "Perempuan",
            "address" => "Jr. Karel S. Tubun No. 615, Administrasi Jakarta Barat 62613, Kalbar",
            "father" => "Hari Thamrin",
            "mother" => "Gawati Hilda Suartini",
            "guardian" => "Karimah Agustina",
        ],))->save();
        (new Student([
            "name" => "Malik Uwais",
            "student_number" => "9796974977",
            "date_of_bird" => "2010-08-09",
            "gender" => "Laki-laki",
            "address" => "Ds. Bakin No. 680, Medan 96539, NTB",
            "father" => "Cahyanto Santoso",
            "mother" => "Ciaobella Lalita Wahyuni",
            "guardian" => "Labuh Maryadi S.IP",
        ]))->save();
    }
}
