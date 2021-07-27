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
        $user->assignRole(request('roles'));
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
