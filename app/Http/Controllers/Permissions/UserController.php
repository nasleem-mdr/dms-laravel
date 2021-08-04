<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function create()
    {
        return view('permission.assign.user.create', [
            'roles' => Role::get(),
            'users' => User::has('roles')->get(),
        ]);
    }

    public function store()
    {
        $user = User::where('email', request('email'))->first();
        $rolesID = request('roles');
        $roles = array();
        foreach ($rolesID as $roleID) {
            array_push(
                $roles,
                Role::where('id', $roleID)->get()->first()->name
            );
        }

        if ((in_array('super admin', $roles) || in_array('admin', $roles)) && !in_array('pegawai', $roles)) {
            $employeeRoleID = Role::where('name', 'pegawai')->get()->first()->id;
            array_push($rolesID, (string)$employeeRoleID);
            $user->assignRole($rolesID, 'pegawai');
        } else {

            $user->assignRole($rolesID);
        }

        return back();
    }

    public function edit(User $user)
    {
        return view('permission.assign.user.edit', [
            'user' => $user,
            'roles' => Role::get(),
            'users' => User::has('roles')->get(),
        ]);
    }

    public function update(User $user)
    {
        $user->syncRoles(request('roles'));
        return redirect()->route('assign.user.create')->with('success', 'The roles has been synced');
    }
}
