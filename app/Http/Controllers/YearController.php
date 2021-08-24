<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function create()
    {
        return view('year.create', [
            'year' => new Year,
            'years' => Year::get()->sortBy('year'),
            'submit' => 'Create',
        ]);
    }

    public function isYearExist($year)
    {
        $years = Year::get();
        foreach ($years as $year) {
            if ($year->year === $year) {
                return true;
            }
        }

        return false;
    }

    public function store()
    {
        request()->validate([
            'year' => 'required',
        ]);

        $yearsInput = explode('-', request('year'));

        if (sizeof($yearsInput) > 1) {
            $yearStart = $yearsInput[0];
            $yearEnd = $yearsInput[1];


            for ($yearInput = $yearStart; $yearInput <= $yearEnd; $yearInput++) {
                if ($this->isYearExist($yearInput)) {
                    Year::create([
                        'year' => $yearInput,
                    ]);
                }
            }
            return back()->with('success', "Tahun telah ditambahkan");
        }

        if (!$this->isYearExist($yearsInput[0])) {
            return back()->with('error', "Gagal menambahkan tahun, tahun {$yearsInput[0]} sudah ada");
        }

        Year::create([
            'year' => $yearsInput[0],
        ]);

        return back()->with('success', "Tahun telah ditambahkan");
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
