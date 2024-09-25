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
        $biro2 = Position::where('name', 'Biro 2 ' . config('app.name'))->first();
        $biro1 = Position::where('name', 'Biro 1 ' . config('app.name'))->first();
        $kepalaTU = Position::where('name', 'Super Admin ' . config('app.name'))->first();
        $biro3 = Position::where('name', 'Biro 3 ' . config('app.name'))->first();
        $lp2m = Position::where('name', 'LP2M ' . config('app.name'))->first();
        
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
            'email' => 'biro1@gmail.com'
        ], [
            'position_id' => $biro1->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_BIRO_1,
            'name' => 'Pio',
            'nip' => '20000704 201505 1 006',
            'date_of_bird' => '2000-07-04',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'biro2@gmail.com'
        ], [
            'position_id' => $biro2->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_BIRO_2,
            'name' => 'Pio',
            'nip' => '20000704 201505 1 006',
            'date_of_bird' => '2000-07-04',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'biro3@gmail.com'
        ], [
            'position_id' => $biro3->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_BIRO_3,
            'name' => 'Pio',
            'nip' => '20000704 201505 1 006',
            'date_of_bird' => '2000-07-04',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        User::firstOrCreate([
            'email' => 'lp2m@gmail.com'
        ], [
            'position_id' => $lp2m->id,
            'password' => Hash::make('password'),
            'is_active' => true,
            'role' => User::ROLE_LP2M,
            'name' => 'Pio',
            'nip' => '20000704 201505 1 006',
            'date_of_bird' => '2000-07-04',
            'gender' => User::GENDER_MALE,
            'address' => 'Situbondo',
        ]);

        

        
    }
}
