<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $defaultProfilePicture = 'default-profile.png';
        //pegawai 1
        $user1 = User::create([
            'username' => '1800018411',
            'email' => 'refinaldy@test.test',
            'password' => Hash::make('refinaldy1800018411'),
        ]);

        $user1->assignRole('pegawai');

        Employee::create([
            'user_id' => $user1->id,
            'nip' => '1800018411',
            'name' => ucwords('refinaldy madras'),
            'agency_id' => 1,
            'address' => 'Yogyakarta',
            'phone_number' => null,
            'position_id' => 1,
            'profile_picture' => $defaultProfilePicture,
        ]);


        // pegawai 2
        $user2 = User::create([
            'username' => '1800018002',
            'email' => 'john@test.test',
            'password' => Hash::make('john1800018002'),
        ]);

        $user2->assignRole('pegawai');

        Employee::create([
            'user_id' => $user2->id,
            'nip' => '1800018002',
            'name' => ucwords('john doe'),
            'agency_id' => 1,
            'address' => 'Jakarta',
            'phone_number' => null,
            'position_id' => 2,
            'profile_picture' => $defaultProfilePicture,
        ]);

        // pegawai 3
        $user3 = User::create([
            'username' => '1800018001',
            'email' => 'joe@test.test',
            'password' => Hash::make('joe1800018001'),
        ]);

        $user3->assignRole('pegawai');

        Employee::create([
            'user_id' => $user3->id,
            'nip' => '1800018001',
            'name' => ucwords('joe dohn'),
            'agency_id' => 3,
            'address' => 'Jakarta',
            'phone_number' => null,
            'position_id' => 1,
            'profile_picture' => $defaultProfilePicture,
        ]);
    }
}
