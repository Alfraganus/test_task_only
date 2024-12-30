<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarBooking;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cars = Car::all();
        $employees = UserProfile::all();

        CarBooking::factory()->count(30)->make()->each(function ($booking) use ($cars, $employees) {
            $booking->car_id = $cars->random()->id;
            $booking->employee_id = $employees->random()->id;

            $startDate = \Carbon\Carbon::create(2025, 1, rand(1, 31));
            $booking->start_time = $startDate;
            $booking->end_time = $startDate->copy()->addDays(3);
            $booking->save();
        });

    }
}
