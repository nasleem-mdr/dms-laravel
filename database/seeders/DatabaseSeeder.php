<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            AgencySeeder::class,
            UserSeeder::class,
            NavigationSeeder::class,
            CategorySeeder::class,
            YearSeeder::class,
            EmployeeSeeder::class,
            ArchiveSeeder::class,
            DocumentSeeder::class,
        ]);
    }
}
