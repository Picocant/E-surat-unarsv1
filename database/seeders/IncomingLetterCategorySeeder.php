<?php

namespace Database\Seeders;

use App\Models\IncomingLetterCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomingLetterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomingLetterCategory::firstOrCreate([
            'name' => 'Surat Undangan',
        ]);
        IncomingLetterCategory::firstOrCreate([
            'name' => 'Surat Pemberitahuan',
        ]);
        IncomingLetterCategory::firstOrCreate([
            'name' => 'Surat Peminjaman',
        ]);
    }
}
