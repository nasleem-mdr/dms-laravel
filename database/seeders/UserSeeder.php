<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Agency;
use App\Models\Employee;
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
        $agency = Agency::get()->first();

        $position = $agency->positions[0];


        Employee::create([
            'user_id' => $superAdmin->id,
            'nip' => '000000000',
            'name' => 'Refinaldy M',
            'agency_id' => 1,
            'address' => null,
            'phone_number' => null,
            'position_id' => $position->id,
        ]);


        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@test.test',
            'password' => Hash::make('admindms'),
        ]);

        $admin->assignRole('admin');
        Employee::create([
            'user_id' => $admin->id,
            'nip' => '000000000',
            'name' => 'John Doe',
            'agency_id' => 1,
            'address' => null,
            'phone_number' => null,
            'position_id' => $position->id,
        ]);
    }
}
