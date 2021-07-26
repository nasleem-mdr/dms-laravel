<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@test.test',
            'password' => Hash::make('superadmindms'),
        ]);

        $superAdmin->assignRole('super admin');

        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@test.test',
            'password' => Hash::make('admindms'),
        ]);

        $admin->assignRole('admin');
    }
}
