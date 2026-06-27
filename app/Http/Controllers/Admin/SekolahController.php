<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    /**
     * Tampilkan seluruh data sekolah dari database MySQL.
     */
    public function index()
    {
        // Mengambil semua data sekolah diurutkan dari yang terbaru
        $allSekolah = Sekolah::latest()->get();
        
        return view('admin.sekolah', compact('allSekolah'));
    }

    /**
     * Simpan data sekolah baru ke database MySQL.
     */
    public function store(Request $request)
    {
        // Validasi input data sekolah
        $request->validate([
            'nama_sekolah' => 'required|string|max:255|unique:sekolahs,nama_sekolah',
            'alamat' => 'required|string',
        ], [
            'nama_sekolah.unique' => 'Nama sekolah sudah terdaftar di sistem MySQL.',
        ]);

        // Menyimpan data ke database MySQL
        Sekolah::create([
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Sekolah baru berhasil didaftarkan ke MySQL!');
    }

    /**
     * Perbarui data sekolah di database MySQL.
     */
    public function update(Request $request, $id)
    {
        $sekolah = Sekolah::findOrFail($id);

        // Validasi input data saat melakukan update
        $request->validate([
            'nama_sekolah' => 'required|string|max:255|unique:sekolahs,nama_sekolah,' . $sekolah->id,
            'alamat' => 'required|string',
        ]);

        // Eksekusi perubahan ke MySQL
        $sekolah->update([
            'nama_sekolah' => $request->nama_sekolah,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Data sekolah berhasil diperbarui di MySQL!');
    }

    /**
     * Hapus data sekolah secara permanen dari database MySQL.
     */
    public function destroy($id)
    {
        $sekolah = Sekolah::findOrFail($id);
        $namaSekolah = $sekolah->nama_sekolah;
        
        // Eksekusi hapus baris data di MySQL
        $sekolah->delete();

        return redirect()->back()->with('success', 'Sekolah "' . $namaSekolah . '" berhasil dihapus dari MySQL!');
    }
}
