<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    //dynamic get total of row in one table
    public function getTotalOf($table)
    {
        $entity = DB::table($table)->get();
        return $entity->count();
    }

    //dynamic get count from agency relation 
    // ex : archives, documents, or employees
    public function getTotal($entity)
    {
        $user = Auth::user();
        $count = $entity . '_count';

        if ($user->hasRole('super admin')) {
            $agencies = Agency::withCount($entity)->get();
            $messages = array();

            foreach ($agencies as $agency) {
                array_push($messages, [
                    'nama_unit' => $agency->name,
                    'total_' . $entity => $agency->$count,
                ]);
            }
        } else {
            $agencyID = $user->employee->agency->id;
            $employees = Agency::withCount($entity)->find($agencyID);
            $messages = [
                'total_' . $entity => $employees->$count,
            ];
        }

        return response()->json($messages, 400);
    }
}
