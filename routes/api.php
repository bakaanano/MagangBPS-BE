<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;



Route::get('/mitra', function () {
    try {
        // Ambil semua data dari tabel mitra
        $mitra = DB::table('mitra')->get();

        return response()->json([
            'success' => true,
            'data' => $mitra
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
});