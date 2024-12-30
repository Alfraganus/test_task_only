<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = \App\Models\Car::class;

    public function definition()
    {
        $carModels = ['Lada Granta', 'Lada Vesta', 'UAZ Patriot', 'Lada Niva', 'Gazel Next'];

        return [
            'model' => $this->faker->randomElement($carModels),
            'license_plate' => strtoupper($this->faker->bothify('???-####')),
        ];
    }
}
