<?php

namespace Database\Seeders;

use App\Models\Archive;
use App\Models\SchoolDocument;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SchoolDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = (new Factory)->create();
        $users = User::all();

        Storage::copy('placeholder.pdf', 'school-documents/1.pdf');
        $doc1 = new SchoolDocument([
            'user_id' => $users[0]->id,
            'name' => 'Sertifikat Akreditasi Sekolah 2020',
            'date' => '2020-05-14',
            'number' => $faker->numerify('NO. ###/BAN-PT/2020/V'),
            'description' => 'Salinan sertifikat akreditasi sekolah 2020',
            'file' => 'school-documents/1.pdf'
        ]);
        $doc1->save();
        $doc1->archive()->save(new Archive());

        Storage::copy('placeholder.pdf', 'school-documents/2.pdf');
        $doc2 = new SchoolDocument([
            'user_id' => $users[0]->id,
            'name' => 'Sertifikat Lahan Sekolah',
            'date' => '2021-10-22',
            'number' => $faker->numerify('NO. ###-#/2021/X'),
            'description' => 'Salinan sertifikat lahan sekolah',
            'file' => 'school-documents/2.pdf'
        ]);
        $doc2->save();
        $doc2->archive()->save(new Archive());


        Storage::copy('placeholder.pdf', 'school-documents/3.pdf');
        $doc3 = new SchoolDocument([
            'user_id' => $users[0]->id,
            'name' => 'Sertifikat Lahan Sekolah',
            'date' => '2015-07-14',
            'number' => $faker->numerify('NO. ###/BAN-PT/2015/VII'),
            'description' => 'Salinan sertifikat akreditasi sekolah tahun 2015',
            'file' => 'school-documents/3.pdf'
        ]);
        $doc3->save();
        $doc3->archive()->save(new Archive());

        Storage::copy('placeholder.pdf', 'school-documents/4.pdf');
        $doc4 = new SchoolDocument([
            'user_id' => $users[0]->id,
            'name' => 'SK Kepala Sekolah',
            'date' => '2022-03-12',
            'number' => $faker->numerify('NO. ###-#/2022/III'),
            'description' => 'Salinan SK kepala sekolah',
            'file' => 'school-documents/4.pdf'
        ]);
        $doc4->save();
        $doc4->archive()->save(new Archive());

        Storage::copy('placeholder.pdf', 'school-documents/5.pdf');
        $doc5 = new SchoolDocument([
            'user_id' => $users[0]->id,
            'name' => 'Akta Sekolah',
            'date' => '2013-11-08',
            'number' => $faker->numerify('NO. ###-#/2013/XI'),
            'description' => 'Salinan akta sekolah',
            'file' => 'school-documents/5.pdf'
        ]);
        $doc5->save();
        $doc5->archive()->save(new Archive());
    }
}
