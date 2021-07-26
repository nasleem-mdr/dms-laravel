<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function create()
    {
        return view('year.create', [
            'year' => new Year,
            'years' => Year::get(),
            'submit' => 'Create',
        ]);
    }

    public function store()
    {
        request()->validate([
            'year' => 'required|unique:years',
        ]);

        $year = Year::create([
            'year' => request('year'),
        ]);

        return back()->with('success', "{$year->year} has been created ");
    }

    public function edit(Year $year)
    {
        return view('year.edit', [
            'year' => $year,
            'submit' => 'Update',
        ]);
    }

    public function update(Year $year)
    {
        request()->validate([
            'year' => 'required|unique:years',
        ]);

        $old = $year->year;

        $year->update([
            'year' => request('year'),
        ]);

        return redirect()->route('year.create')->with('success', "{$old} has been updated to {$year->year}");
    }

    public function destroy(Year $year)
    {
        $yearTemp = $year->year;
        $year->delete();

        return redirect()->route('year.create')->with('success', "{$yearTemp} has been deleted");
    }
}
