<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            'no' => 'Doc/001/',
            'desc' => 'Document 1',
            'file' => 'A.pdf',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
            'document_category_id' =>  1,
        ]);

        Document::create([
            'no' => 'Doc/002/',
            'desc' => 'Document 2',
            'file' => 'B.pdf',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
            'document_category_id' =>  2,
        ]);

        Document::create([
            'no' => 'Doc/003/',
            'desc' => 'Document 3',
            'file' => 'C.pdf',
            'year_id' => 1,
            'employee_id' => 1,
            'agency_id' => 1,
            'document_category_id' =>  2,
        ]);
    }
}
