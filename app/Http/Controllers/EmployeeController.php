<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{


    public function index()
    {
        return view('employee.table', [
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
            'phone_number' => request('phone_number'),
            'position_id' => request('position_id') ?? null,
        ]);


        return redirect()->route('employee.table', [
            'employees' => Employee::get(),
        ]);
    }

    public function destroy(Employee $employee)
    {

        $employeeTemp = $employee->name;
        $employee->user->delete();
        $employee->delete();

        return redirect()->route('employee.table')->with('success', "{$employeeTemp} has been deleted");
    }
}
