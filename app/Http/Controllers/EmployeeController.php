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
            'employees' => Employee::get(),
        ]);
    }

    public function create()
    {
        return view('employee.create', [
            'employee' => new Employee,
            'agencies' => Agency::get(),
            'roles' => Role::get(),
            'submit' => 'Create',
        ]);
    }

    public function store()
    {
        request()->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required',
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

        $user->assignRole(request('roles'));

        Employee::create([
            'user_id' => $user->id,
            'nip' => request('nip'),
            'name' => ucwords(request('name')),
            'agency_id' => request('agency_id'),
            'address' => request('address') ?? null,
            'phone_number' => request('phone_number') ?? null,
            'position_id' => request('position_id'),
        ]);


        return redirect()->route('employee.table', [
            'employees' => Employee::get(),
        ]);
    }

    public function edit(Employee $employee)
    {
        return view('employee.edit', [
            'employee' => $employee,
            'agencies' => Agency::get(),
            'roles' => Role::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Employee $employee)
    {
        request()->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required',
            'agency_id' => 'required',
            'position_id' => 'required',
            'roles' => 'required',
        ]);

        $employee->update([
            'nip' => request('nip'),
            'name' => ucwords(request('name')),
            'agency_id' => request('agency_id'),
            'address' => request('address') ?? null,
            'phone_number' => request('phone_number') ?? null,
            'position_id' => request('position_id'),
        ]);

        $user = User::find($employee->user->id);
        $user->syncRoles(request('roles'));

        return redirect()->route('employee.table')->with('success', "Data {$employee->name} telah diperbaruhi");
    }

    public function resetPassword(Employee $employee)
    {
        $user = User::find($employee->user->id);
        $names = explode(' ', $employee->name);

        $user->update([
            'password' => $names[0] . $employee->nip,
        ]);

        return redirect()->route('employee.table')->with('success', "Password {$employee} telah direset");
    }

    public function destroy(Employee $employee)
    {

        $employeeTemp = $employee->name;
        $employee->user->delete();
        $employee->delete();

        return redirect()->route('employee.table')->with('success', "{$employeeTemp} telah dihapus");
    }
}
