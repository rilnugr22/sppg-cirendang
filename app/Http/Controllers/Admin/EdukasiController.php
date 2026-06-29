<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    /**
     * Tampilkan halaman utama kelola edukasi dengan data dari MySQL.
     */
    public function index()
    {
        // Mengambil semua konten edukasi terurut dari yang terbaru
        $allEdukasi = Edukasi::latest()->get();
        return view('admin.edukasi', compact('allEdukasi'));
    }

    /**
     * Simpan konten edukasi baru ke MySQL beserta file gambar cover.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:Artikel,Video',
            'konten' => 'required|string',
            'tanggal_publish' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi gambar maks 2MB
        ]);

        $namaGambar = null;
        
        // Logika memproses upload file gambar jika ada
        if ($request->hasFile('gambar')) {
            // Membuat nama file yang unik menggunakan timestamp & string acak
            $namaGambar = time() . '_' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            
            // Simpan langsung ke folder public/uploads/edukasi/
            $request->file('gambar')->move(public_path('uploads/edukasi'), $namaGambar);
        }

        Edukasi::create([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'konten' => $request->konten,
            'tanggal_publish' => $request->tanggal_publish,
            'gambar' => $namaGambar, // Menyimpan nama file gambar ke database
        ]);

        return redirect()->back()->with('success', 'Konten edukasi baru berhasil diterbitkan ke MySQL!');
    }

    /**
     * Perbarui data konten edukasi di database MySQL termasuk file gambar baru.
     */
    public function update(Request $request, $id)
    {
        $edukasi = Edukasi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:Artikel,Video',
            'konten' => 'required|string',
            'tanggal_publish' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi gambar maks 2MB
        ]);

        // Siapkan array data dasar yang akan diperbarui
        $dataUpdate = [
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'konten' => $request->konten,
            'tanggal_publish' => $request->tanggal_publish,
        ];

        // Logika ganti file gambar jika ada file baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus file gambar lama dari folder public/uploads/edukasi/ jika ada
            if (!empty($edukasi->gambar) && file_exists(public_path('uploads/edukasi/' . $edukasi->gambar))) {
                unlink(public_path('uploads/edukasi/' . $edukasi->gambar));
            }

            // Upload file gambar baru langsung ke public/uploads/edukasi/
            $namaGambar = time() . '_' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move(public_path('uploads/edukasi'), $namaGambar);
            
            // Masukkan nama file gambar baru ke dalam array pembaruan
            $dataUpdate['gambar'] = $namaGambar;
        }

        $edukasi->update($dataUpdate);

        return redirect()->back()->with('success', 'Konten edukasi berhasil diperbarui!');
    }

    /**
     * Hapus konten edukasi secara permanen beserta file gambarnya dari disk storage.
     */
    public function destroy($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        $judul = $edukasi->judul;
        
        // Perbaikan Error: Hapus file fisik gambar menggunakan unlink() bawaan PHP
        if (!empty($edukasi->gambar) && file_exists(public_path('uploads/edukasi/' . $edukasi->gambar))) {
            unlink(public_path('uploads/edukasi/' . $edukasi->gambar));
        }

        $edukasi->delete();

        return redirect()->back()->with('success', 'Konten "' . $judul . '" berhasil dihapus dari MySQL!');
    }
}