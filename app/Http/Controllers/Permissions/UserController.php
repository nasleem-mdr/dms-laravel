<?php

namespace App\Http\Controllers\Permissions;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        request()->validate([
            'nip' => 'required|digits_between:8,18',
            'roles' => 'required',
        ]);

        $user = User::where('username', request('nip'))->first();
        if ($user === null) {
            return back()->with('error', 'Data NIP pegawai tidak ditemukan');
        }

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
        request()->validate([
            'nip' => 'required|digits_between:8,18',
            'roles' => 'required',
        ]);

        $user = User::where('username', request('nip'))->first();
        if ($user === null) {
            return back()->with('error', 'Data NIP pegawai tidak ditemukan');
        }

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
            $user->syncRoles($rolesID, 'pegawai');
        } else {
            $user->syncRoles($rolesID);
        }

        $loginUser = Auth::user();
        $loginUser = User::find($loginUser->id);

        if (($loginUser->hasRole('super admin'))) {
            return redirect()->route('assign.user.create')->with('success', 'Role user berhasil diperbarui');
        }

        return redirect()->route('dashboard');
    }
}
