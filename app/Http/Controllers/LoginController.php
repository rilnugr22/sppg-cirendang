<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan formulir login.
     */
    public function show()
    {
        // Jika sudah login, paksa masuk ke dashboard saja, tidak boleh buka halaman login lagi
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Tangani proses autentikasi form login.
     */
    public function login(Request $request)
    {
        // 1. Validasi Input Form
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Format ulang untuk kueri autentikasi default Laravel (mencocokkan name & password di MySQL)
        $loginData = [
            'name' => $credentials['username'],
            'password' => $credentials['password']
        ];

        // 3. Eksekusi Login Percobaan
        if (Auth::attempt($loginData)) {
            // Regenerasi session demi keamanan dari pembajakan session fixasi
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        // 4. Jika gagal, kembalikan ke halaman login dengan membawa flash error session
        return redirect()->back()
            ->withInput($request->only('username'))
            ->with('error', 'Username atau password yang Anda masukkan salah.');
    }

    /**
     * Tangani proses keluar sistem (Logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}