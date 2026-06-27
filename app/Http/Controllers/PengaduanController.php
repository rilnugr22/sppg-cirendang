<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    /**
     * SISI PUBLIK: Menyimpan pengaduan baru dari masyarakat melalui beranda.
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form aduan
        $request->validate([
            'kategori' => 'required|string|in:Porsi,Keterlambatan,Kualitas Makanan,Higienitas,Lainnya',
            'deskripsi' => 'required|string|min:10',
            'foto_bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        // 2. Membuat Nomor Tiket Acak Otomatis (Contoh: TKT-12345678)
        $nomorTiket = 'TKT-' . rand(10000000, 99999999);

        // 3. Kelola pengunggahan file foto bukti jika ada
        $namaFoto = null;
        if ($request->hasFile('foto_bukti')) {
            $foto = $request->file('foto_bukti');
            $namaFoto = time() . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('uploads/pengaduan'), $namaFoto);
        }

        // 4. Menyimpan data aduan ke dalam database MySQL
        Pengaduan::create([
            'nomor_tiket' => $nomorTiket,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'foto_bukti' => $namaFoto,
            'pelapor' => $request->has('anonim') ? 'Anonim' : ($request->pelapor ?? 'Anonim'),
            'status' => 'Terkirim'
        ]);

        // 5. Kembali ke halaman beranda dengan menyertakan session tiket sukses
        return redirect()->back()->with('success_tiket', $nomorTiket);
    }

    /**
     * SISI ADMIN: Menampilkan semua daftar pengaduan dengan fitur filter status.
     */
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        // Menyaring data jika admin mengklik salah satu tombol status filter
        if ($request->has('status') && in_array($request->status, ['Terkirim', 'Dibaca', 'Diproses', 'Selesai'])) {
            $query->where('status', $request->status);
        }

        $allPengaduan = $query->latest()->get();

        return view('admin.pengaduan', compact('allPengaduan'));
    }

    /**
     * SISI ADMIN: Memperbarui status kelayakan pengaduan dari detail modal.
     */
    public function updateStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Terkirim,Dibaca,Diproses,Selesai',
        ]);

        $pengaduan->update([
            'status' => $request->status // Memperbarui status ke Terkirim / Dibaca / Diproses / Selesai
        ]);

        return redirect()->back()->with('success', 'Status pengaduan ' . $pengaduan->nomor_tiket . ' berhasil diperbarui!');
    }
}