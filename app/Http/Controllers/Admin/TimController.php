<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimSppg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TimController extends Controller
{
    /**
     * Tampilkan semua anggota tim dari database MySQL.
     */
    public function index()
    {
        $allTim = TimSppg::latest()->get();
        return view('admin.tim', compact('allTim'));
    }

    /**
     * Simpan anggota tim baru ke MySQL & unggah foto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFoto = null;

        // Logika Pengunggahan File Foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tim'), $namaFoto);
        }

        TimSppg::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $namaFoto,
        ]);

        return redirect()->back()->with('success', 'Anggota tim baru berhasil didaftarkan ke MySQL!');
    }

    /**
     * Perbarui data anggota tim & kelola perubahan file foto.
     */
    public function update(Request $request, $id)
    {
        $tim = TimSppg::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFoto = $tim->foto;

        if ($request->hasFile('foto')) {
            // Hapus foto lama di server jika ada
            if ($tim->foto && File::exists(public_path('uploads/tim/' . $tim->foto))) {
                File::delete(public_path('uploads/tim/' . $tim->foto));
            }

            // Unggah foto baru
            $file = $request->file('foto');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tim'), $namaFoto);
        }

        $tim->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $namaFoto,
        ]);

        return redirect()->back()->with('success', 'Data anggota tim berhasil diperbarui!');
    }

    /**
     * Hapus anggota tim secara permanen & hapus file foto dari folder server.
     */
    public function destroy($id)
    {
        $tim = TimSppg::findOrFail($id);
        $namaAnggota = $tim->nama;

        // Hapus file fisik foto jika ada di direktori
        if ($tim->foto && File::exists(public_path('uploads/tim/' . $tim->foto))) {
            File::delete(public_path('uploads/tim/' . $tim->foto));
        }

        $tim->delete();

        return redirect()->back()->with('success', 'Anggota tim "' . $namaAnggota . '" berhasil dihapus dari MySQL!');
    }
}