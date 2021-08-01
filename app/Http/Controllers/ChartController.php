<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Archive;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    //dynamic get total of row in one table
    public function getTotalOf($table)
    {
        $entity = DB::table($table)->get();
        return response()->json([
            'total_' . $table => $entity->count()
        ], 200);
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

        return response()->json($messages, 200);
    }

    public function getTotalOfEntityByYear($entity)
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
            $table = Agency::withCount($entity)->find($agencyID);

            $years = Year::withCount($entity)->get();
            $newCount = array();
            foreach ($years as $year) {
                foreach ($year->$entity as $index => $item) {
                    if ($item->agency_id === $table->id)
                        array_push(
                            $newCount,
                            [
                                'total_archives' =>  $year->$count,
                                'year' => $year->year,
                                'agency' => $item->agency->name,
                            ]
                        );
                }
            }
            $messages = array_unique($newCount, SORT_REGULAR);
        }

        return response()->json($messages, 200);
    }
}
