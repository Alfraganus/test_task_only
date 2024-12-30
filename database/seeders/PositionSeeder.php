<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run()
    {
        $positions = ['Manager', 'Supervisor', 'Executive', 'Assistant'];

        foreach ($positions as $position) {
            Position::create(['name' => $position]);
        }
    }
}
