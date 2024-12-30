<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileSeeder extends Seeder
{

    public function run()
    {
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        User::factory()
            ->count(20)
            ->withProfile()
            ->create()
            ->each(function (User $user) use ($employeeRole) {
                $user->assignRole($employeeRole);
            });

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        $admin->assignRole($adminRole);
    }
}
