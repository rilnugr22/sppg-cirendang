<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SekolahController;
use App\Http\Controllers\Admin\TimController;
use App\Http\Controllers\Admin\EdukasiController;
use App\Http\Controllers\Admin\MenuGiziController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. ROUTES SISI PUBLIK (Masyarakat / Orang Tua Siswa)
|--------------------------------------------------------------------------
*/

// Halaman utama publik: Beranda, Filter Menu Gizi, dan Profil Tim
Route::get('/', [PagesController::class, 'index'])->name('home');

// Form Action: Untuk menangani pengiriman form pengaduan masyarakat dari Beranda
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');


/*
|--------------------------------------------------------------------------
| 2. ROUTES GUEST (Form Login - Hanya bisa diakses sebelum masuk sistem)
|--------------------------------------------------------------------------
*/
// 1. Jalur untuk menampilkan halaman login & proses login (diluar middleware auth)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.proses');



Route::middleware('guest')->group(function () {
    // Taruh Route Logout di dalam sini agar hanya admin yang sudah login yang bisa mengaksesnya
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Jalur menu dashboard, pengaduan, edukasi, dll milikmu...
  Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});
/*
|--------------------------------------------------------------------------
| 3. ROUTES SISI ADMIN (Diproteksi Ketat Menggunakan Middleware Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Utama Dashboard Admin (Statistik & Grafik)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // --- KELOLA USER (CRUD) ---
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // --- KELOLA SEKOLAH (CRUD) ---
    Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
    Route::post('/sekolah', [SekolahController::class, 'store'])->name('sekolah.store');
    Route::put('/sekolah/{id}', [SekolahController::class, 'update'])->name('sekolah.update');
    Route::delete('/sekolah/{id}', [SekolahController::class, 'destroy'])->name('sekolah.destroy');

    // --- KELOLA TIM SPPG (CRUD) ---
    Route::get('/tim', [TimController::class, 'index'])->name('tim.index');
    Route::post('/tim', [TimController::class, 'store'])->name('tim.store');
    Route::put('/tim/{id}', [TimController::class, 'update'])->name('tim.update');
    Route::delete('/tim/{id}', [TimController::class, 'destroy'])->name('tim.destroy');

    // --- KELOLA KONTEN EDUKASI (CRUD) ---
    Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi.index');
    Route::post('/edukasi', [EdukasiController::class, 'store'])->name('edukasi.store');
    Route::put('/edukasi/{id}', [EdukasiController::class, 'update'])->name('edukasi.update');
    Route::delete('/edukasi/{id}', [EdukasiController::class, 'destroy'])->name('edukasi.destroy');

    // --- KELOLA MENU GIZI (CRUD) ---
    Route::get('/menu-gizi', [MenuGiziController::class, 'index'])->name('menu_gizi.index');
    Route::post('/menu-gizi', [MenuGiziController::class, 'store'])->name('menu_gizi.store');
    Route::put('/menu-gizi/{id}', [MenuGiziController::class, 'update'])->name('menu_gizi.update');
    Route::delete('/menu-gizi/{id}', [MenuGiziController::class, 'destroy'])->name('menu_gizi.destroy');

    // --- KELOLA PENGADUAN (Sisi Admin) ---
    // Menampilkan daftar pengaduan masuk
   Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    
    // PASTIKAN yang di dalam kurung siku adalah 'updateStatus'
    Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
});