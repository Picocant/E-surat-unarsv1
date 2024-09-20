<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guru = Position::where('name', 'Biro ' . config('app.name'))->first();
        $kepalaSekolah = Position::where('name', 'Rektor ' . config('app.name'))->first();
        $kepalaTU = Position::where('name', 'Super Admin ' . config('app.name'))->first();
        $staf = Position::where('name', 'Admin ' . config('app.name'))->first();

        User::firstOrCreate([
            'email' => 'superadmin@gmail.com'
        ], [
            'position_id' => $kepalaTU->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_KEPALA_TU,
            'name' => 'Pico',
            'nip' => '20000704 201505 1 006',
            'date_of_bird' => '2000-07-04',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'biro@gmail.com'
        ], [
            'position_id' => $guru->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_GURU,
            'name' => 'Pio',
            'nip' => '20000420 201505 1 007',
            'date_of_bird' => '2000-04-20',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'position_id' => $staf->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_STAF_TU,
            'name' => 'Andra ',
            'nip' => '19730926 201505 1 009',
            'date_of_bird' => '1973-09-26',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'rektor@gmail.com'
        ], [
            'position_id' => $kepalaSekolah->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_KEPALA_SEKOLAH,
            'name' => 'Surya',
            'nip' => '19670505 198804 1 002',
            'date_of_bird' => '2001-11-09',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);
    }
}
