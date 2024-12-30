<?php

namespace Database\Seeders;

use App\Models\ComfortCategory;
use Illuminate\Database\Seeder;

class ComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ComfortCategory::create(['name' => 'Economy']);
        ComfortCategory::create(['name' => 'Business']);
        ComfortCategory::create(['name' => 'Luxury']);
    }
}
