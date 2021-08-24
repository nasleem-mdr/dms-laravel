<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function index()
    {
        return view('employee.table', [
            'user' => Auth::user(),
            'employees' => Employee::with('position', 'agency', 'user', 'archives', 'documents')->get(),
        ]);
    }

    public function create()
    {
        return view('employee.create', [
            'user' => Auth::user(),
            'users' => User::with('employee')->get(),
            'employee' => new Employee,
            'agencies' => Agency::get(),
            'roles' => Role::get(),
            'submit' => 'Create',
        ]);
    }

    public function store()
    {

        request()->validate([
            'nip' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'required|unique:users|string|email',
            'agency_id' => 'required',
            'position_id' => 'required',
            'roles' => 'required',
        ]);

        $names = explode(' ', request('name'));

        $password = strtolower($names[0] . request('nip'));

        $user = User::create([
            'username' => request('nip'),
            'email' => request('email'),
            'password' => Hash::make($password),
        ]);

        $rolesID = request('roles');
        $roles = array();
        foreach ($rolesID as $roleID) {
            array_push(
                $roles,
                Role::where('id', $roleID)->get()->first()->name
            );
        }

        if (Auth::user()->hasRole('admin')) {
            foreach ($roles as $role) {
                if ($role === 'super admin') {
                    return back()->with('error', 'Admin tidak dapat menambahkan super admin');
                }
            }
        }

        if ((in_array('super admin', $roles) || in_array('admin', $roles)) && !in_array('pegawai', $roles)) {
            $employeeRoleID = Role::where('name', 'pegawai')->get()->first()->id;
            array_push($rolesID, (string)$employeeRoleID);
            $user->assignRole($rolesID, 'pegawai');
        } else {
            $user->assignRole($rolesID);
        }

        $fileName = 'default-profile.png';

        Employee::create([
            'user_id' => $user->id,
            'nip' => request('nip'),
            'name' => ucwords(request('name')),
            'agency_id' => request('agency_id'),
            'address' => request('address') ?? null,
            'phone_number' => request('phone_number') ?? null,
            'position_id' => request('position_id'),
            'profile_picture' => $fileName,
        ]);

        return redirect()->route('employee.table', [
            'employees' => Employee::get(),
        ]);
    }

    public function edit(Employee $employee, Role $role)
    {
        return view('employee.edit', [
            'user' => Auth::user(),
            'employee' => $employee,
            'agencies' => Agency::get(),
            'roles' => Role::get(),
            'role' => $role,
            'submit' => 'Update',
        ]);
    }

    public function update(Employee $employee)
    {
        if ($employee->user->email === request('email')) {
            $emailValidation = 'required|string|email';
        } else {
            $emailValidation = 'required|unique|users|string|email';
        }

        request()->validate([
            'name' => 'required',
            'email' => $emailValidation,
            'agency_id' => 'required',
            'position_id' => 'required',
            'roles' => 'required',
        ]);


        $fileName = $employee->profile_picture;

        $employee->update([
            'name' => ucwords(request('name')),
            'agency_id' => request('agency_id'),
            'address' => request('address') ?? null,
            'phone_number' => request('phone_number') ?? null,
            'position_id' => request('position_id'),
            'profile_picture' => $fileName,
        ]);

        $user = User::find($employee->user->id);
        $user->syncRoles(request('roles'));

        $names = explode(' ', request('name'));

        $user->update([
            'email' => request('email'),
        ]);

        return redirect()->route('employee.table')->with('success', "Data {$employee->name} telah diperbaruhi");
    }

    public function resetPassword(Employee $employee)
    {
        $user = User::find($employee->user->id);
        $names = explode(' ', $employee->name);
        $password = strtolower($names[0]) . $employee->nip;
        $user->update([
            'password' => Hash::make($password),
        ]);

        return redirect()->route('employee.table')->with('success', "Password {$employee->name} telah direset");
    }

    public function destroy(Employee $employee)
    {
        $employeeTemp = $employee->name;

        if ($employee->user->hasRole('super admin')) {
            $users = User::get();
            $count = 0;
            foreach ($users as $user) {
                if ($user->hasRole('super admin')) {
                    $count++;
                }
            }

            if ($count === 1) {
                return redirect()->route('employee.table')->with('error', "{$employeeTemp} tidak dapat dihapus karena hak akses super admin hanya tersisa satu akun");
            }
        }

        $employee->user->delete();
        $employee->delete();

        return redirect()->route('employee.table')->with('success', "{$employeeTemp} telah dihapus");
    }
}
