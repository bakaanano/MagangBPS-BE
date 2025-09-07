<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// use App\Http\Controllers\SupabaseController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::get('/matriks_kegiatan', function () {
    try {
        // Ambil semua data dari tabel matriks_kegiatan
        $mk = DB::table('matriks_kegiatan')->get();

        return response()->json([
            'success' => true,
            'data' => $mk
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/rekap_honor', function () {
    try {
        // Ambil semua data dari tabel rekap_honor
        $rh = DB::table('rekap_honor')->get();

        return response()->json([
            'success' => true,
            'data' => $rh
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/honor_mitra_bulanan', function () {
    try {
        // Ambil semua data dari tabel honor_mitra_bulanan
        $hmb = DB::table('honor_mitra_bulanan')->get();

        return response()->json([
            'success' => true,
            'data' => $hmb
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
});
