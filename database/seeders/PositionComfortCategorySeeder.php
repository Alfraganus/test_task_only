<?php
namespace Database\Seeders;

use App\Models\ComfortCategory;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionComfortCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = Position::all();
        $comfortCategories = ComfortCategory::all();

        foreach ($positions as $position) {
            $categoriesToAssign = $comfortCategories->random(rand(1, 3));

            foreach ($categoriesToAssign as $comfortCategory) {
                $position->comfortCategories()->attach($comfortCategory->id);
            }
        }
    }
}
