<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        return view('agency.table', [
            'agencies' => Agency::get(),
        ]);
    }

    public function show(Agency $agency)
    {
        return view('agency.show', [
            'agency' => $agency,
        ]);
    }

    public function create()
    {
        return view('agency.create', [
            'agency' => new Agency,
            'submit' => 'Create',
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
        ]);

        Agency::create([
            'name' => request('name'),
            'address' => request('address'),
            'contact' => request('contact'),
        ]);

        return redirect()->route('agency.table');
    }

    public function edit(Agency $agency)
    {
        return view('agency.edit', [
            'agency' => $agency,
            'submit' => 'Update',
        ]);
    }

    public function update(Agency $agency)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $agency->update([
            'name' => request('name'),
            'address' => request('address'),
            'contact' => request('contact'),
        ]);

        return redirect()->route('agency.table');
    }

    public function destroy(Agency $agency)
    {
        $agency->delete();
        return redirect()->route('agency.table');
    }
}
