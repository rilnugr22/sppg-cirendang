<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekolah;
use App\Models\TimSppg;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung data untuk kartu statistik (seperti di video)
        $totalUsers = User::count();
        $totalSekolah = Sekolah::count();
        $totalTim = TimSppg::count();
        $totalPengaduan = Pengaduan::count();

        // 2. Menghitung Statistik Harian / Kinerja (Persentase Keterlambatan)
        // Rumus: (Jumlah aduan keterlambatan / Total semua aduan) * 100
        $aduanTerlambat = Pengaduan::where('kategori', 'Keterlambatan')->count();
        
        $persentaseKeterlambatan = 0;
        if ($totalPengaduan > 0) {
            $persentaseKeterlambatan = ($aduanTerlambat / $totalPengaduan) * 100;
            // Membulatkan 1 angka di belakang koma (misal: 33.3)
            $persentaseKeterlambatan = round($persentaseKeterlambatan, 1); 
        }

        // 3. Mengambil data pengaduan terbaru untuk ringkasan di dashboard
        $pengaduanTerbaru = Pengaduan::latest()->take(5)->get();

        // Kirim semua variabel ke view dashboard admin
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalSekolah', 
            'totalTim', 
            'totalPengaduan', 
            'persentaseKeterlambatan',
            'pengaduanTerbaru'
        ));
    }
}