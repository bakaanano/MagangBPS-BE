<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Ambil data dengan pagination (100 per halaman)
            $perPage = 100;
            $mitra = DB::table('mitra')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $mitra->items(),
                'pagination' => [
                    'current_page'  => $mitra->currentPage(),
                    'per_page'      => $mitra->perPage(),
                    'total'         => $mitra->total(),
                    'last_page'     => $mitra->lastPage(),
                    'next_page_url' => $mitra->nextPageUrl(),
                    'prev_page_url' => $mitra->previousPageUrl(),
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
