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
            'username' => '2021001',
            'email' => 'superadmin@test.test',
            'password' => Hash::make('superadmindms'),
        ]);

        $superAdmin->assignRole('super admin', 'pegawai');
        $agency = Agency::get()->first();

        $position = $agency->positions[0];
        $default_picture = 'default-profile.png';

        Employee::create([
            'user_id' => $superAdmin->id,
            'nip' => '2021001',
            'name' => 'Refinaldy M',
            'agency_id' => 1,
            'address' => null,
            'phone_number' => null,
            'position_id' => $position->id,
            'profile_picture' => $default_picture,
        ]);


        $admin = User::create([
            'username' => '2021002',
            'email' => 'admin@test.test',
            'password' => Hash::make('admindms'),
        ]);

        $admin->assignRole('admin', 'pegawai');
        Employee::create([
            'user_id' => $admin->id,
            'nip' => '2021002',
            'name' => 'John Doe',
            'agency_id' => 1,
            'address' => null,
            'phone_number' => null,
            'position_id' => $position->id,
            'profile_picture' => $default_picture,
        ]);
    }
}
