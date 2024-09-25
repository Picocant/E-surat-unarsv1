<?php

namespace Database\Seeders;

use App\Models\Letter;
use App\Models\SppdLetter;
use App\Models\SppdLetterRecipient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SppdLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $biro1 = User::where('role', User::ROLE_BIRO_1)->first();
        $users = User::where('role', '!=', User::ROLE_BIRO_1)->get();

        foreach ($users as $index => $user) {
            $sppdLetter = new SppdLetter;
            $sppdLetter->from_user_id = $biro1->id;
            $sppdLetter->budget = 2000000;
            $sppdLetter->start_date = now()->format('Y-m-d');
            $sppdLetter->end_date = now()->addDays(5)->format('Y-m-d');
            $sppdLetter->purpose = 'Menjalin hubungan antara sekolah';
            $sppdLetter->destination = 'SDN ' . ++$index . ' Barito Kuala';
            $sppdLetter->save();
            $sppdLetter->letter()->save(new Letter([
                'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi'
            ]));

            $recipient = new SppdLetterRecipient();
            $recipient->sppd_letter_id = $sppdLetter->id;
            $recipient->user_id = $user->id;
            $recipient->save();
        }
    }
}
