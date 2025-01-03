<?php

namespace Database\Seeders;

use App\Models\Driver;
use Database\Factories\DriverFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Driver::factory()->count(10)->create();
    }
}
