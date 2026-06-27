<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuGizi;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MenuGiziController extends Controller
{
    /**
     * Tampilkan seluruh data menu gizi dan relasi sekolah dari MySQL.
     */
    public function index()
    {
        // Eager loading relasi sekolah
        $allMenuGizi = MenuGizi::with('sekolah')->latest()->get();
        $allSekolah = Sekolah::all();

        return view('admin.menu_gizi', compact('allMenuGizi', 'allSekolah'));
    }

    /**
     * Simpan data menu gizi baru ke database MySQL & unggah gambar menu.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'porsi' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'sekolah_id' => 'required|exists:sekolahs,id',
            'kalori' => 'required|integer|min:0',
            'protein' => 'required|integer|min:0',
            'lemak' => 'required|integer|min:0',
            'karbohidrat' => 'required|integer|min:0',
            'foto_menu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFoto = null;

        // Logika Pengunggahan File Gambar Menu Makanan
        if ($request->hasFile('foto_menu')) {
            $file = $request->file('foto_menu');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu'), $namaFoto);
        }

        MenuGizi::create([
            'nama_menu' => $request->nama_menu,
            'porsi' => $request->porsi,
            'tanggal' => $request->tanggal,
            'sekolah_id' => $request->sekolah_id,
            'kalori' => $request->kalori,
            'protein' => $request->protein,
            'lemak' => $request->lemak,
            'karbohidrat' => $request->karbohidrat,
            'foto_menu' => $namaFoto,
        ]);

        return redirect()->back()->with('success', 'Menu makanan baru berhasil didistribusikan ke database MySQL!');
    }

    /**
     * Perbarui data menu gizi & kelola penggantian file gambar lama.
     */
    public function update(Request $request, $id)
    {
        $menu = MenuGizi::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required|string|max:255',
            'porsi' => 'required|integer|min:1',
            'tanggal' => 'nullable|date',
            'sekolah_id' => 'required|exists:sekolahs,id',
            'foto_menu' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kalori' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'lemak' => 'required|numeric|min:0',
            'karbohidrat' => 'required|numeric|min:0',
        ]);

        $namaFoto = $menu->foto_menu;

        if ($request->hasFile('foto_menu')) {
            // Hapus gambar lama jika ada di server
            if ($menu->foto_menu && File::exists(public_path('uploads/menu/' . $menu->foto_menu))) {
                File::delete(public_path('uploads/menu/' . $menu->foto_menu));
            }

            // Unggah gambar baru
            $file = $request->file('foto_menu');
            $namaFoto = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu'), $namaFoto);
        }

        $menu->update([
            'nama_menu' => $request->nama_menu,
            'porsi' => $request->porsi,
            'tanggal' => $request->tanggal ?? $menu->tanggal,
            'sekolah_id' => $request->sekolah_id,
            'kalori' => $request->kalori,
            'protein' => $request->protein,
            'lemak' => $request->lemak,
            'karbohidrat' => $request->karbohidrat,
            'foto_menu' => $namaFoto,
        ]);

        return redirect()->back()->with('success', 'Detail Menu Gizi berhasil diperbarui di database!');
    }

    /**
     * Hapus data menu gizi beserta file gambarnya dari server.
     */
    public function destroy($id)
    {
        $menu = MenuGizi::findOrFail($id);
        $namaMenu = $menu->nama_menu;

        // Hapus file fisik gambar jika ada
        if ($menu->foto_menu && File::exists(public_path('uploads/menu/' . $menu->foto_menu))) {
            File::delete(public_path('uploads/menu/' . $menu->foto_menu));
        }

        $menu->delete();

        return redirect()->back()->with('success', 'Menu "' . $namaMenu . '" berhasil dihapus dari MySQL!');
    }
}