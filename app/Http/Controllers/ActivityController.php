<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Activity;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ActivityResource;

class ActivityController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('super admin')) {
            $agencies = Agency::get();
            $items =  Activity::with('user')->latest()->get()->groupBy(function ($item) {
                return $item->created_at->format('d-M-y');
            });
            // $items = Activity::get()->groupBy(function ($item) {
            //     return $item->created_at->format('d:M:y');
            // });
            // $data = [];
            // foreach ($items as $key => $item) {
            //     $data[$key] = ActivityResource::collection($item);
            // }

            return view('activity.index', [
                'user' => $user,
                'items' => $items,
                'agencies' => $agencies ?? new Agency(),
            ]);
        } else if ($user->hasRole('admin')) {
            $employees = Employee::with('user')->where('agency_id', $user->employee->agency->id)->get();

            $items =  Activity::join('users', 'activities.user_id', '=', 'users.id')
                ->join('employees', 'employees.user_id', '=', 'users.id')
                // ->join('agencies', 'agencies.id', '=', 'employees.agency_id')
                ->where('employees.agency_id', '=', $user->employee->agency->id)
                ->latest()->get(['activities.created_at', 'activities.activity', 'users.username'])->groupBy(function ($item) {
                    return $item->created_at->format('d-m-Y');
                });
        } else {
            $items =  Activity::with('user')->where('user_id', $user->id)->latest()->get()->groupBy(function ($item) {
                return $item->created_at->format('d-M-y');
            });
        }

        return view('activity.index', [
            'user' => $user,
            'items' => $items,
        ]);
    }

    public function show($agencyID)
    {
        $user = Auth::user();
        if ($user->hasRole("super admin")) {
            $items =  Activity::join('users', 'activities.user_id', '=', 'users.id')
                ->join('employees', 'employees.user_id', '=', 'users.id')
                ->join('agencies', 'agencies.id', '=', 'employees.agency_id')
                ->where('agencies.id', '=', $agencyID)
                ->latest('activities.created_at')->get(['activities.created_at', 'activities.activity', 'activities.user_id'])
                ->sortBy('activities.created_at')->groupBy(function ($item) {
                    return $item->created_at->format('d-m-Y');
                });
        }

        $data = [];
        foreach ($items as $key => $item) {
            $data[$key] = ActivityResource::collection($item);
        }

        return $data;
    }
}
