<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\MenuGizi;
use App\Models\TimSppg;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data tim untuk ditampilkan di seksi "Tim Kami"
        $allTim = TimSppg::all();

        // 2. Ambil semua data sekolah untuk pilihan dropdown filter menu
        $allSekolah = Sekolah::all();

        // 3. Logika Filter Pencarian Menu Gizi
        $queryMenu = MenuGizi::with('sekolah'); // Menggunakan relasi model yang sudah dibuat

        // 4. Ambil seluruh data dari tabel edukasis di MySQL
        $allEdukasi = Edukasi::latest()->get();

        // Jika user memfilter berdasarkan tanggal
        if ($request->has('tanggal') && $request->tanggal != '') {
            $queryMenu->whereDate('tanggal', $request->tanggal);
        }

        // Jika user memfilter berdasarkan sekolah
        if ($request->has('sekolah_id') && $request->sekolah_id != 'Semua Sekolah') {
            $queryMenu->where('sekolah_id', $request->sekolah_id);
        }

        $daftarMenu = $queryMenu->latest()->get();

        // Kirim semua data ke file blade landing page (tambahkan 'allEdukasi' di dalam fungsi compact)
        return view('welcome', compact('allTim', 'allSekolah', 'daftarMenu', 'allEdukasi'));

    }
}