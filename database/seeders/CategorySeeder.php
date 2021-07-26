<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            'surat masuk',
            'surat keluar',
            'surat keputusan',
        ]);

        $categories->each(function ($category) {
            DocumentCategory::create([
                'category' => $category,
            ]);
        });
    }
}
