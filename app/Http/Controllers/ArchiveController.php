<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Year;
use App\Models\Archive;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        if ($user->hasRole('super admin')) {
            $archives = Archive::get();
        } else if ($user->hasRole('admin')) {
            $archives = Archive::where('agency_id', $user->employee->agency_id)->get();
        } else {
            $archives = Archive::where('employee_id', $user->employee->id)->get();
        }

        return view('archive.table', compact('archives', 'user'));
    }

    public function create()
    {

        return view('archive.create', [
            'archive' => new Archive,
            'years' => Year::get(),
            'submit' => 'Create',
        ]);
    }

    public function store()
    {
        request()->validate([
            'no' => 'required',
            'desc' => 'required',
            'year_id' => 'required',
        ]);

        $user = Auth::user();
        $user = User::find($user->id);
        $employeeID = $user->employee->id;
        $agencyID = $user->employee->agency_id;

        Archive::create([
            'no' => request('no'),
            'desc' => request('desc'),
            'year_id' => request('year_id'),
            'employee_id' => $employeeID,
            'agency_id' => $agencyID,
        ]);

        return redirect()->route('archive.table')->with('message', 'New Archive has been added');
    }

    public function edit(Archive $archive)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        if ($user->id !== $archive->employee->id && !$user->hasRole(['super admin', 'admin'])) {
            abort('403');
        }

        return view('archive.edit', [
            'archive' => $archive,
            'years' => Year::get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Archive $archive)
    {
        $user = Auth::user();
        $user = User::find($user->id);

        if ($user->id !== $archive->employee->id && !$user->hasRole(['super admin', 'admin'])) {
            abort('403');
        }

        request()->validate([
            'no' => 'required',
            'desc' => 'required',
            'year_id' => 'required',
        ]);

        $oldArchive = $archive->no;

        $archive->update([
            'no' => request('no'),
            'desc' => request('desc'),
            'year_id' => request('year_id'),
        ]);

        return redirect()->route('archive.table')->with('success', "Arsip No. {$oldArchive} telah diperbaruhi menjadi {$archive->no}");
    }

    public function destroy(Archive $archive)
    {
        $tempArchive = $archive->no;
        $archive->delete();
        return redirect()->route('archive.table')->with('success', "Arsip No. {$tempArchive} telah dihapus");
    }
}
