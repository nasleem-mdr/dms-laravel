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

        $roleAndPermission = Navigation::create([
            'name' => 'Role & Permission',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Roles',
            'url' => 'role-and-permission/roles/',
            'parent_id' => $roleAndPermission->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Permissions',
            'url' => 'role-and-permission/permissions/',
            'parent_id' => $roleAndPermission->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Assign Permission',
            'url' => 'role-and-permission/assignable',
            'parent_id' => $roleAndPermission->id,
            'permission_name' => 'assign permission',
        ]);

        Navigation::create([
            'name' => 'Permission to Users',
            'url' => 'role-and-permission/assign/user',
            'parent_id' => $roleAndPermission->id,
            'permission_name' => 'assign permission',
        ]);

        $navigation = Navigation::create([
            'name' => 'Navigation Settings',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Create new menu',
            'url' => 'navigation/create',
            'parent_id' => $navigation->id,
            'permission_name' => 'create navigation',
        ]);

        Navigation::create([
            'name' => 'Navigation Table',
            'url' => 'navigation/table',
            'parent_id' => $navigation->id,
            'permission_name' => 'create navigation',
        ]);

        $agency = Navigation::create([
            'name' => 'Agency',
            'url' => null,
            'parent_id' => null,
            'permission_name' => 'create agency',
        ]);

        Navigation::create([
            'name' => 'Create new Agency',
            'url' => 'agency/create',
            'parent_id' => $agency->id,
            'permission_name' => 'create agency',
        ]);

        Navigation::create([
            'name' => 'Agency Table',
            'url' => 'agency/table',
            'parent_id' => $agency->id,
            'permission_name' => 'create agency',
        ]);
    }
}
