<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\ComfortCategory;
use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = ComfortCategory::all();
        $drivers = Driver::all();

        Car::factory()->count(50)->make()->each(function ($car) use ($categories, $drivers) {
            $car->comfort_category_id = $categories->random()->id;
            $car->driver_id = $drivers->random()->id;
            $car->save();
        });
    }
}
