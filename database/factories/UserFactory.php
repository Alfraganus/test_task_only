<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected $model = User::class;
    protected static int $emailCounter = 1;

    public function definition(): array
    {
        $email = 'user' . self::$emailCounter++ . '@gmail.com';
        return [
            'name' => $this->faker->name(),
            'email' =>$email,
            'email_verified_at' => now(),
            'password' => Hash::make('1234'),
            'remember_token' => Str::random(10),
        ];
    }


    public function withProfile(): static
    {
        return $this->afterCreating(function (User $user) {
            $position = Position::inRandomOrder()->first();

            UserProfile::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'position_id' => $position ? $position->id : null,
            ]);
        });
    }
}
