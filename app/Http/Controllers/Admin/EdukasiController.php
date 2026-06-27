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
     * Simpan konten edukasi baru ke MySQL.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:Artikel,Video',
            'konten' => 'required|string',
            'tanggal_publish' => 'required|date',
        ]);

        Edukasi::create([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'konten' => $request->konten,
            'tanggal_publish' => $request->tanggal_publish,
        ]);

        return redirect()->back()->with('success', 'Konten edukasi baru berhasil diterbitkan ke MySQL!');
    }

    /**
     * Perbarui data konten edukasi di database MySQL.
     */
    public function update(Request $request, $id)
    {
        $edukasi = Edukasi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:Artikel,Video',
            'konten' => 'required|string',
            'tanggal_publish' => 'required|date',
        ]);

        $edukasi->update([
            'judul' => $request->judul,
            'tipe' => $request->tipe,
            'konten' => $request->konten,
            'tanggal_publish' => $request->tanggal_publish,
        ]);

        return redirect()->back()->with('success', 'Konten edukasi berhasil diperbarui!');
    }

    /**
     * Hapus konten edukasi secara permanen dari MySQL.
     */
    public function destroy($id)
    {
        $edukasi = Edukasi::findOrFail($id);
        $judul = $edukasi->judul;
        
        $edukasi->delete();

        return redirect()->back()->with('success', 'Konten "' . $judul . '" berhasil dihapus dari MySQL!');
    }
}