<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    //dynamic get total of row in one table
    public function getTotalOf($table)
    {
        $entity = DB::table($table)->get();
        return $entity->count();
    }

    // jumlah pegawai pada suatu instansi
    public function getTotalEmployees()
    {
        $agencies = Agency::withCount('employees')->get();
        $messages = array();
        foreach ($agencies as $agency) {
            array_push($messages, [
                'nama_unit' => $agency->name,
                'total_pegawai' => $agency->employees_count,
            ]);
        }
        return response()->json($messages, 400);
    }

    public function getTotalArchives()
    {
        $agencies = Agency::withCount('archives')->get();
        $messages = array();
        foreach ($agencies as $agency) {
            array_push($messages, [
                'nama_unit' => $agency->name,
                'total_arsip' => $agency->archives_count,
            ]);
        }
        return response()->json($messages, 400);
    }

    public function getTotalDocuments()
    {
        $agencies = Agency::withCount('documents')->get();
        $messages = array();
        foreach ($agencies as $agency) {
            array_push($messages, [
                'nama_unit' => $agency->name,
                'total_dokumen' => $agency->documents_count,
            ]);
        }
        return response()->json($messages, 400);
    }
}
