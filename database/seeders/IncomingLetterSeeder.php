<?php

namespace Database\Seeders;

use App\Models\IncomingLetter;
use App\Models\IncomingLetterCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class IncomingLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suratUndangan = IncomingLetterCategory::where('name', 'Surat Undangan')->first();
        $suratPeminjaman = IncomingLetterCategory::where('name', 'Surat Peminjaman')->first();
        $suratPemberitahuan = IncomingLetterCategory::where('name', 'Surat Pemberitahuan')->first();

        Storage::copy('placeholder.pdf', 'incoming-letters/1.pdf');
        (new IncomingLetter([
            'incoming_letter_category_id' => $suratUndangan->id,
            'letter_number' => '421.2/UNARS/SU/2022/V',
            'regarding' => 'Undangan Perpisahan',
            'attachment' => '-',
            'from' => 'SDN 1 Keruwing Raya',
            'to' => 'Kepala ' . config('app.name'),
            'date' => '2022-01-04',
            'file' => 'incoming-letters/1.pdf',
        ]))->save();
    }
}
