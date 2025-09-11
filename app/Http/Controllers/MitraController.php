<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    public function databasemitra(Request $request)
    {
        try {
            // ambil per_page & page dari query, lalu clamp biar aman
            $perPage = (int) $request->query('per_page', 100);
            $perPage = max(1, min($perPage, 200)); // 1..200
            $page    = (int) $request->query('page', 1);

            $query = DB::table('mitra')->orderBy('id', 'asc'); // ordering konsisten

            // paginate + appends semua query kecuali page
            $mitra = $query
                ->paginate($perPage, ['*'], 'page', $page)
                ->appends($request->except('page'));

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
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}