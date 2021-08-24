<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('super admin')) {
            $item =  Activity::with('user', 'user.employee')->latest()->get()->groupBy(function ($item) {
                return $item->created_at->format('d-M-y');
            });
        } else if ($user->hasRole('admin')) {
            $employees = Employee::with('user')->where('agency_id', $user->employee->agency->id)->get();

            $item =  Activity::join('users', 'activities.user_id', '=', 'users.id')
                ->join('employees', 'employees.user_id', '=', 'users.id')
                // ->join('agencies', 'agencies.id', '=', 'employees.agency_id')
                ->where('employees.agency_id', '=', $user->employee->agency->id)
                ->latest()->get(['activities.created_at', 'activities.activity', 'users.username'])->groupBy(function ($item) {
                    return $item->created_at->format('d-m-Y');
                });
        } else {
            $item =  Activity::with('user')->where('user_id', $user->id)->latest()->get()->groupBy(function ($item) {
                return $item->created_at->format('d-M-y');
            });
        }

        return view('activity.index', compact('item', 'user'));
    }
}
