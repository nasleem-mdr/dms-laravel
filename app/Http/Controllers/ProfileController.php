<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $employee = $user->employee;
        return view('profile.show', compact('employee'));
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
            'employee' => Auth::user()->employee,
            'submit' => 'Update Profile',
        ]);
    }

    public function update()
    {
        $employee = Employee::where('nip', request('nip'))->first();

        if ($employee->user->email === request('email')) {
            $emailValidation = 'required';
        } else {
            $emailValidation = 'required|unique:users';
        }
        request()->validate([
            'name' => 'required',
            'email' => $emailValidation,
        ]);

        $employee->update([
            'name' => ucwords(request('name')),
            'address' => request('address') ?? null,
            'phone_number' => request('phone_number') ?? null,
        ]);

        $user = User::find($employee->user->id);

        $user->update([
            'username' => request('nip'),
            'email' => request('email'),
        ]);

        return redirect()->route('profile.show')->with('success', "Profile telah diperbaruhi");
    }

    public function editPassword(Employee $employee)
    {
        return view('profile.edit_password', compact('employee'));
    }

    public function resetPassword()
    {
        $user = Auth::user();
        $user = User::find($user->id);

        request()->validate([
            'old_password' => 'required|string|min:8',
            'password' => 'required|string|min:8',
        ]);

        if (!Hash::check(request('old_password'), $user->password)) {
            return back()->with('error_message', 'Password Lama Salah');
        }

        $user->update([
            'password' => Hash::make(request('password')),
        ]);

        return redirect()->route('profile.reset_password')->with('success', "Password berhasil diperbaruhi");
    }
}
