<?php

namespace Database\Seeders;

use App\Models\IncomingLetter;
use App\Models\IncomingLetterDisposition;
use App\Models\Signature;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomingLetterDispositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incomingLetters = IncomingLetter::all();
        $user = User::where('role', User::ROLE_REKTOR)->first();

        foreach ($incomingLetters as $incomingLetter) {
            $incomingLetterDisposition = new IncomingLetterDisposition([
                'incoming_letter_id' => $incomingLetter->id,
                'to' => 'Tata Usaha Bagian Humas',
                'type' => IncomingLetterDisposition::TYPE_NORMAL,
                'message' => 'Segera proses surat yang masuk.',
            ]);
            $incomingLetterDisposition->save();

            $incomingLetterDisposition->signature()->save(new Signature([
                'payload' => Signature::buildPayload([
                    'Tipe' => 'Disposisi Surat',
                    'Nomor Surat' => $incomingLetter->letter_number
                ], $user)
            ]));
        }
    }
}
