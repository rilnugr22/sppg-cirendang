<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // 1. READ: Menampilkan semua data user dari MySQL
    public function index()
    {
        $allUsers = User::latest()->get();
        return view('admin.users', compact('allUsers'));
    }

    // 2. CREATE: Menyimpan user baru ke MySQL
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,name|max:255',
            'role' => 'required|in:Super Admin,Staff Gizi,Petugas Sekolah',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->username,
            'role' => $request->role,
            'email' => $request->username . '@sppg.local', // Email dummy agar memenuhi syarat default Laravel
            'password' => Hash::make($request->password), // Password di-hash demi keamanan database
        ]);

        return redirect()->back()->with('success', 'User baru berhasil didaftarkan ke database MySQL!');
    }

    // 3. UPDATE: Mengubah data user di MySQL
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|max:255|unique:users,name,' . $user->id,
            'role' => 'required|in:Super Admin,Staff Gizi,Petugas Sekolah',
        ]);

        $user->update([
            'name' => $request->username,
            'role' => $request->role,
        ]);

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back()->with('success', 'Data user berhasil diperbarui di database MySQL!');
    }

    // 4. DELETE: Menghapus user secara permanen dari MySQL
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $username = $user->name;
        $user->delete();

        return redirect()->back()->with('success', 'User "' . $username . '" berhasil dihapus dari database MySQL!');
    }
}