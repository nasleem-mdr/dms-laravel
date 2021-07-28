<?php

namespace Database\Seeders;

use App\Models\Archive;
use Illuminate\Database\Seeder;

class ArchiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Archive::create([
            'no' => '001/LPP/012',
            'desc' => 'Arsip X',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
        ]);

        Archive::create([
            'no' => '002/LPP/012',
            'desc' => 'Arsip Y',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
        ]);

        Archive::create([
            'no' => '003/LPP/012',
            'desc' => 'Arsip Z',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
        ]);

        Archive::create([
            'no' => '004/LPP/012',
            'desc' => 'Arsip A',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
        ]);

        Archive::create([
            'no' => '005/LPP/012',
            'desc' => 'Arsip B',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
        ]);
    }
}
