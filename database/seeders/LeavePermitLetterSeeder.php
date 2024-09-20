<?php

namespace Database\Seeders;

use App\Models\LeavePermitLetter;
use App\Models\Letter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeavePermitLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $leavePermitLetter = new LeavePermitLetter;
            $leavePermitLetter->user_id = $user->id;
            $leavePermitLetter->regarding = 'Izin Cuti';
            $leavePermitLetter->attachment = '-';
            $leavePermitLetter->reason = 'Menghabiskan sisa jatah cuti';
            $leavePermitLetter->start_date = now()->format('Y-m-d');
            $leavePermitLetter->end_date = now()->addDays(5)->format('Y-m-d');
            $leavePermitLetter->save();
            $leavePermitLetter->letter()->save(new Letter([
                'note' => 'Surat telah dibuat dan menunggu untuk diverifikasi',
            ]));
        }
    }
}
