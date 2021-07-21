<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavigationController extends Controller
{

    public function table()
    {
        return view('navigation.table', [
            'navigations' => Navigation::whereNotNull('url')->get(),
        ]);
    }

    public function create()
    {
        return view('navigation.create', [
            'permissions' => Permission::get(),
            'navigations' => Navigation::where('url', null)->get(),
            'submit' => 'Create',
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required',
            'permission_name' => 'required',

        ]);

        Navigation::create([
            'name' => request('name'),
            'url' => request('url') ?? null,
            'parent_id' => request('parent_id') ?? null,
            'permission_name' => request('permission_name'),

        ]);

        return back();
    }

    public function edit(Navigation $navigation)
    {
        return view('navigation.edit', [
            'navigation' => $navigation,
            'permissions' => Permission::get(),
            'navigations' => Navigation::where('url', null)->get(),
            'submit' => 'Update',
        ]);
    }

    public function update(Navigation $navigation)
    {
        $navigation->update([
            'name' => request('name'),
            'url' => request('url') ?? null,
            'parent_id' => request('parent_id') ?? null,
            'permission_name' => request('permission_name'),
        ]);

        return redirect()->route('navigation.table');
    }

    public function destroy(Navigation $navigation)
    {
        $navigation->delete();
        return redirect()->route('navigation.table');
    }
}
