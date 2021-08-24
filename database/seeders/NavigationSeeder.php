<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $archive = Navigation::create([
            'name' => 'Arsip Kepegawaian',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create archive',
        ]);

        Navigation::create([
            'name' => 'Tabel Arsip Kepegawaian',
            'url' => 'archive/table',
            'parent_id' => $archive->id,
            'permission_name' => 'create archive',
        ]);

        $document = Navigation::create([
            'name' => 'Arsip Dokumen',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create document',
        ]);

        Navigation::create([
            'name' => 'Tabel Arsip Dokumen',
            'url' => 'document/table',
            'parent_id' => $document->id,
            'permission_name' => 'create document',
        ]);

        $agency = Navigation::create([
            'name' => 'Unit',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create agency',
        ]);

        Navigation::create([
            'name' => 'Tambah Unit Baru',
            'url' => 'agency/create',
            'parent_id' => $agency->id,
            'permission_name' => 'create agency',
        ]);

        Navigation::create([
            'name' => 'Tabel Unit',
            'url' => 'agency/table',
            'parent_id' => $agency->id,
            'permission_name' => 'create agency',
        ]);

        $employee = Navigation::create([
            'name' => 'Pegawai',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create employee',
        ]);

        Navigation::create([
            'name' => 'Tabel Pegawai',
            'url' => 'employee/table',
            'parent_id' => $employee->id,
            'permission_name' => 'create employee',
        ]);

        $master = Navigation::create([
            'name' => 'Master',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'master',
        ]);

        Navigation::create([
            'name' => 'Kelola Role',
            'url' => 'role-and-permission/roles/',
            'parent_id' => $master->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Kelola Akses Perizinan',
            'url' => 'role-and-permission/permissions/',
            'parent_id' => $master->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Perizinan Untuk Role',
            'url' => 'role-and-permission/assignable',
            'parent_id' => $master->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Role Untuk User',
            'url' => 'role-and-permission/assign/user',
            'parent_id' => $master->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Tambah menu Baru',
            'url' => 'navigation/create',
            'parent_id' => $master->id,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Tabel Navigasi',
            'url' => 'navigation/table',
            'parent_id' => $master->id,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Table Kategori Dokumen',
            'url' => 'category/create',
            'parent_id' => $master->id,
            'permission_name' => 'create category',
        ]);

        Navigation::create([
            'name' => 'Table Tahun',
            'url' => 'year/create',
            'parent_id' => $master->id,
            'permission_name' => 'create year',
        ]);

        $activity = Navigation::create([
            'name' => 'Aktivitas',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'show activity',
        ]);

        Navigation::create([
            'name' => 'Aktivitas Pengguna',
            'url' => 'activities',
            'parent_id' => $activity->id,
            'permission_name' => 'show activity',
        ]);
    }
}
