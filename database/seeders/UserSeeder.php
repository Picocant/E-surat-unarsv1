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
        $superadmin = Position::where('name', 'Super Admin ' . config('app.name'))->first();
        $rektor = Position::where('name', 'Rektor ' . config('app.name'))->first();
        $biro1 = Position::where('name', 'Biro 1 ' . config('app.name'))->first();
        $biro2 = Position::where('name', 'Biro 2 ' . config('app.name'))->first();

        User::firstOrCreate([
            'email' => 'superadmin@gmail.com'
        ], [
            'position_id' => $superadmin->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_SUPERADMIN,
            'name' => 'Pico',
            'nip' => '20000704 201505 1 006',
            'date_of_bird' => '2000-07-04',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);
        
        User::firstOrCreate([
            'email' => 'rektor@gmail.com'
        ], [
            'position_id' => $rektor->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_REKTOR,
            'name' => 'Surya',
            'nip' => '19670505 198804 1 002',
            'date_of_bird' => '2001-11-09',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'biro1@gmail.com'
        ], [
            'position_id' => $biro1->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_BIRO1,
            'name' => 'Andra ',
            'nip' => '19730926 201505 1 009',
            'date_of_bird' => '1973-09-26',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'biro2@gmail.com'
        ], [
            'position_id' => $biro2->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_BIRO2,
            'name' => 'Pio',
            'nip' => '20000420 201505 1 007',
            'date_of_bird' => '2000-04-20',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

    }
}
