<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Navigation::create([
            'name' => 'Role & Permission',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Roles',
            'url' => 'role-and-permission/roles/',
            'parent_id' => 1,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Permissions',
            'url' => 'role-and-permission/permissions/',
            'parent_id' => 1,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Assign Permission',
            'url' => 'role-and-permission/assignable',
            'parent_id' => 1,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Permission to Users',
            'url' => 'role-and-permission/assign/user',
            'parent_id' => 1,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Navigation Settings',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Create new menu',
            'url' => 'navigation/create',
            'parent_id' => 2,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Navigation Table',
            'url' => 'navigation/table',
            'parent_id' => 2,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Agency',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create agency',
        ]);

        Navigation::create([
            'name' => 'Create new Agency',
            'url' => 'agency/create',
            'parent_id' => 3,
            'permission_name' => 'create agency',
        ]);

        Navigation::create([
            'name' => 'Agency Table',
            'url' => 'agency/table',
            'parent_id' => 3,
            'permission_name' => 'create agency',
        ]);
    }
}
