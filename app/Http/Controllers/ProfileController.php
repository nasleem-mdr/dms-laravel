<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

    function saveFile(Request $request, $agencyID)
    {
        $fileName = null;
        $names = explode('.', $request->profile_picture->getClientOriginalName());

        if ($request->profile_picture) {
            $fileName = $names[0] . '-' . time() . '-' . request('nip') . '-' . 'profile-picture'
                . '.' . $request->profile_picture->extension();
            $location = $request->profile_picture->move(public_path('/images/profile/employees/' . $agencyID . '/'), $fileName);
            // $request->profile_picture->move('../public_html/images/profile/employees/' . $agencyID . '/', $fileName);
        }
        $location = '/images/profile/employees/' . $agencyID . '/' . $fileName;
        return $location;
    }

    public function editProfilePicture(Employee $employee)
    {
        return view('employee.profile-picture', [
            'employee' => $employee,
        ]);
    }

    public function updateProfilePicture(Employee $employee)
    {
        $location = $employee->profile_picture;
        if (request('profile_picture') !== null) {
            $agencyID = $employee->agency->id;
            $location = $this->saveFile(request(), $agencyID);
        }

        $employee->update([
            'profile_picture' => $location,
        ]);

        return redirect()->route('profile.show')->with('success', 'Foto Profil Berhasil Digantikan');
    }

    public function update()
    {
        $employee = Auth::user()->employee;

        if ($employee->user->email === request('email')) {
            $emailValidation = 'required|email';
        } else {
            $emailValidation = 'required|unique:users|email';
        }

        request()->validate([
            'name' => 'required',
            'email' => $emailValidation,
            'phone_number' => 'digits_between:8,14',
        ]);

        $employee->update([
            'name' => ucwords(request('name')),
            'address' => request('address') ?? null,
            'phone_number' => request('phone_number') ?? null,
        ]);

        $user = User::find($employee->user->id);


        $user->update([
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
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->numbers()
            ],
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
