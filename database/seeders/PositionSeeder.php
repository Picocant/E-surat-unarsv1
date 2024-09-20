<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::firstOrCreate([
            'name' => 'Biro ' . config('app.name'),
        ]);
        Position::firstOrCreate([
            'name' => 'Rektor ' . config('app.name'),
        ]);
        Position::firstOrCreate([
            'name' => 'Super Admin ' . config('app.name'),
        ]);
        Position::firstOrCreate([
            'name' => 'Admin ' . config('app.name'),
        ]);
    }
}
