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

    function saveFile(Request $request, $agencyName)
    {
        $fileName = null;

        $names = explode('.', $request->file->getClientOriginalName());
        if ($request->file) {
            $fileName = $names[0] . '-' . time() . '-' . request('nip') . '-' . 'profile-picture'
                . '.' . $request->file->extension();
            $request->file->move(public_path('images/profile/employees/' . $agencyName), $fileName);
        }

        return $fileName;
    }

    public function store()
    {
        request()->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
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

        $fileName = 'default-profile.png';
        if (request('profile_picture') !== null) {
            $agencyName = Agency::find(request('agency_id'))->name;
            $fileName = $this->saveFile(request(), $agencyName);
        }

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
        if ($employee->user->email === request('email')) {
            $emailValidation = 'required';
        } else {
            $emailValidation = 'required|unique|users';
        }

        request()->validate([
            'nip' => 'required',
            'name' => 'required',
            'email' => $emailValidation,
            'agency_id' => 'required',
            'position_id' => 'required',
            'roles' => 'required',
        ]);

        $fileName = $employee->profile_picture;
        if (request('profile_picture') !== null) {
            $agencyName = $employee->agency->name;
            $fileName = $this->saveFile(request(), $agencyName);
        }

        $employee->update([
            'nip' => request('nip'),
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
            'username' => request('nip'),
            'email' => request('email'),
        ]);

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
