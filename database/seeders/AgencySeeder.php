<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\Position;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agency::create([
            'name' => 'Unit 1',
            'address' => 'Yogyakarta',
            'contact' => '082255988912',
        ]);

        $positions = collect([
            'Chief Executife Officer',
            'Chief Technology Officer',
            'Technical Architect',
            'Chief Operations Officer',
            'Product Manager',
            'Chief Marketing Officer',
            'Sales manager',
            'Chief Financial Officer',
            'Business Development Manager',
        ]);

        $positions->each(function ($position) {
            Position::create([
                'position' => $position,
                'agency_id' => 1,
            ]);
        });

        Agency::create([
            'name' => 'Unit 2',
            'address' => 'Samarinda',
            'contact' => '082212312121',
        ]);

        $positions->each(function ($position) {
            Position::create([
                'position' => $position,
                'agency_id' => 2,
            ]);
        });

        Agency::create([
            'name' => 'Unit 3',
            'address' => 'Makassar',
            'contact' => '082209907667',
        ]);

        $positions->each(function ($position) {
            Position::create([
                'position' => $position,
                'agency_id' => 3,
            ]);
        });

        Agency::create([
            'name' => 'Unit 4',
            'address' => 'Jakarta',
            'contact' => '081201947667',
        ]);

        $positions->each(function ($position) {
            Position::create([
                'position' => $position,
                'agency_id' => 4,
            ]);
        });

        Agency::create([
            'name' => 'Unit 5',
            'address' => 'Surabaya',
            'contact' => '089767765665',
        ]);

        $positions->each(function ($position) {
            Position::create([
                'position' => $position,
                'agency_id' => 5,
            ]);
        });
    }
}
