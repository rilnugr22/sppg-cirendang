<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengaduan - SPPG Kokrosono</title>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">

    <!-- MODAL DETAIL PENGADUAN (Lihat Detail Pengaduan) -->
    <div id="detail-modal" class="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4 transition-all duration-300">
        <div class="bg-white rounded-2xl border border-gray-100 w-full max-w-lg p-6 shadow-xl transform scale-95 transition-all duration-300 overflow-y-auto max-h-[90vh]" id="modal-container">
            <div class="flex justify-between items-center mb-5 border-b border-gray-100 pb-3">
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest block">Nomor Tiket</span>
                    <h3 id="detail-tiket" class="text-lg font-black text-gray-900">#TIKET-0000</h3>
                </div>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600 bg-gray-50 p-1.5 rounded-lg border hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <!-- Info Status, Tanggal & Pelapor -->
                <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-100 text-sm">
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase block mb-0.5">Kategori Masalah</span>
                        <span id="detail-kategori" class="font-bold text-gray-800">-</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase block mb-0.5">Nama Pelapor</span>
                        <span id="detail-pelapor" class="font-semibold text-gray-700">-</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase block mb-0.5">Tanggal Masuk</span>
                        <span id="detail-tanggal" class="text-gray-600">-</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase block mb-0.5">Status Pengaduan</span>
                        <div class="mt-1" id="detail-status-badge">
                            <!-- Badge di-render dinamis lewat JS -->
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Keluhan -->
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Deskripsi Lengkap Masalah</span>
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm text-gray-700 leading-relaxed max-h-48 overflow-y-auto" id="detail-deskripsi">
                        -
                    </div>
                </div>

                <!-- Foto Bukti Lapangan -->
                <div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Foto Bukti Aduan</span>
                    <div class="border rounded-xl bg-gray-100 overflow-hidden h-48 flex items-center justify-center">
                        <img id="detail-img" src="https://placehold.co/600x400/f3f4f6/9ca3af?text=Tidak+Ada+Foto+Bukti" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Form untuk Memperbarui Status Langsung dari Detail -->
                <form id="update-status-form" method="POST" action="" class="pt-4 border-t border-gray-100 flex items-center justify-between gap-4">
                    @csrf
                    @method('PUT')
                    <div class="flex-1">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Tindak Lanjut / Ubah Status</label>
                        <select name="status" id="detail-select-status" class="w-full border border-gray-200 rounded-lg p-2 text-xs font-bold focus:ring-1 focus:ring-[#071E48] outline-none cursor-pointer bg-white">
                            <option value="Terkirim">TERKIRIM</option>
                            <option value="Dibaca">DIBACA</option>
                            <option value="Diproses">DIPROSES</option>
                            <option value="Selesai">SELESAI</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-[#071E48] hover:bg-[#0D2D69] text-white font-bold text-xs px-4 py-3.5 rounded-lg shadow-sm transition shrink-0 self-end">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- NAVIGASI KIRI / SIDEBAR -->
    <div class="w-64 bg-gray-950 text-white flex flex-col shrink-0 hidden md:flex border-r border-gray-900">
        <!-- Brand Logo Area -->
        <div class="p-5 font-bold text-lg border-b border-gray-900 flex items-center gap-3">
            <img src="{{ asset('img/bgn_logo.png') }}" alt="Logo SPPG" class="w-8 h-8 object-contain rounded-md">
            <span class="text-[#D4B16D] tracking-wide font-extrabold text-xl">SPPG Admin</span>
        </div>
        
        <!-- Menu Items List -->
        <div class="flex-1 py-6 space-y-7 overflow-y-auto">
            <!-- Kategori 1: Menu Utama -->
            <div>
                <p class="px-5 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Menu Utama</p>
                <div class="space-y-1">
                    <!-- 1. Dashboard -->
                    <a href="dashboard" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        Dashboard
                    </a>
                    <!-- 2. Users -->
                    <a href="users" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Users
                    </a>
                    <!-- 3. Sekolah -->
                    <a href="sekolah" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Sekolah
                    </a>
                    <!-- 4. Tim SPPG -->
                    <a href="tim" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Tim SPPG
                    </a>
                </div>
            </div>

            <!-- Kategori 2: Publikasi Konten -->
            <div>
                <p class="px-5 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Publikasi Konten</p>
                <div class="space-y-1">
                    <!-- 5. Edukasi -->
                    <a href="edukasi" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Edukasi
                    </a>
                    <!-- 6. Menu Gizi -->
                    <a href="menu-gizi" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menu Gizi
                    </a>
                    <!-- 7. Pengaduan (ACTIVE STATE) -->
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-sm font-semibold bg-gray-900 border-l-4 border-[#D4B16D] text-white transition">
                        <svg class="w-5 h-5 text-[#D4B16D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Pengaduan
                    </a>
                </div>
            </div>
            <!-- Kategori 3: Utilitas -->
            <div>
                <p class="px-5 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Utilitas</p>
                <div class="space-y-1">
                    <!-- Lihat Situs Publik Link -->
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Lihat Situs Publik
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Footer Logged In User Info -->
        <div class="p-4 border-t border-gray-900 text-xs text-gray-500 bg-gray-950/50 flex items-center gap-3 shrink-0">
            <div class="w-8 h-8 rounded-full bg-green-500/10 text-green-500 font-bold flex items-center justify-center border border-green-500/20">
                A
            </div>
            <div>
                <p class="text-gray-400 font-semibold leading-none mb-1">Admin SPPG</p>
                <p class="text-[10px] text-gray-600 leading-none">Administrator</p>
            </div>
        </div>
    </div>

    <!-- Area Konten Utama Dashboard (Kanan) -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Header Atas Panel Admin -->
        <header class="bg-white shadow-xs h-16 flex items-center justify-between px-6 border-b border-gray-200 shrink-0">
            <h1 class="text-lg font-bold text-gray-900">Daftar Pengaduan Masyarakat</h1>
            <div class="text-xs font-semibold text-gray-600 bg-gray-100 px-3 py-2 rounded-lg border border-gray-200 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                <span>Hari ini: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
            </div>
        </header>

        <!-- Bagian Canvas Utama Scrollable -->
        <main class="flex-1 overflow-y-auto p-6 space-y-6">
            
            <!-- Tab Filter Status Pengaduan -->
            <div class="border-b border-gray-200 bg-white p-2.5 rounded-xl border flex flex-wrap gap-2 shadow-xs">
                <a href="{{ route('admin.pengaduan.index') }}" 
                   class="px-4 py-2 text-xs font-bold rounded-lg transition {{ !request('status') ? 'bg-[#071E48] text-white shadow-xs' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    Semua
                </a>
                <a href="{{ route('admin.pengaduan.index', ['status' => 'Terkirim']) }}" 
                   class="px-4 py-2 text-xs font-bold rounded-lg transition {{ request('status') == 'Terkirim' ? 'bg-red-600 text-white shadow-xs' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    Terkirim
                </a>
                <a href="{{ route('admin.pengaduan.index', ['status' => 'Dibaca']) }}" 
                   class="px-4 py-2 text-xs font-bold rounded-lg transition {{ request('status') == 'Dibaca' ? 'bg-amber-500 text-white shadow-xs' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    Dibaca
                </a>
                <a href="{{ route('admin.pengaduan.index', ['status' => 'Diproses']) }}" 
                   class="px-4 py-2 text-xs font-bold rounded-lg transition {{ request('status') == 'Diproses' ? 'bg-blue-600 text-white shadow-xs' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    Diproses
                </a>
                <a href="{{ route('admin.pengaduan.index', ['status' => 'Selesai']) }}" 
                   class="px-4 py-2 text-xs font-bold rounded-lg transition {{ request('status') == 'Selesai' ? 'bg-green-600 text-white shadow-xs' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                    Selesai
                </a>
            </div>

            <!-- Pesan Sukses / Error Laravel Session -->
            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-800 text-sm font-semibold rounded-xl flex items-center gap-2 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Tabel Data Pengaduan dari MySQL -->
            <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200 bg-gray-50 font-bold text-gray-700 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-red-500 animate-pulse"></span>
                        <span>Aduan Masuk (Filter: {{ request('status') ?? 'Semua' }})</span>
                    </div>
                    <span class="text-xs bg-gray-200 text-gray-700 px-2.5 py-1 rounded-md" id="pengaduan-count">Total: {{ $allPengaduan->count() }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="pengaduan-table">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-200">
                                <th class="p-4 font-semibold w-12">No</th>
                                <th class="p-4 font-semibold w-36">Nomor Tiket</th>
                                <th class="p-4 font-semibold">Tanggal & Waktu</th>
                                <th class="p-4 font-semibold">Kategori</th>
                                <th class="p-4 font-semibold">Pelapor</th>
                                <th class="p-4 font-semibold w-32">Status</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allPengaduan as $index => $aduan)
                                <tr class="pengaduan-row border-b border-gray-200 hover:bg-gray-50/50 text-sm text-gray-700 transition">
                                    <td class="p-4 font-semibold text-gray-500">{{ $index + 1 }}</td>
                                    <td class="p-4 font-black text-gray-900">{{ $aduan->nomor_tiket }}</td>
                                    <td class="p-4 text-gray-500">
                                        {{ $aduan->created_at ? $aduan->created_at->translatedFormat('d F Y (H:i)') : '-' }}
                                    </td>
                                    <td class="p-4">
                                        <span class="bg-gray-100 text-gray-800 px-2.5 py-1 rounded-md text-xs font-semibold border border-gray-200">
                                            {{ $aduan->kategori }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-gray-600">
                                        {{ $aduan->pelapor ?: 'Anonim' }}
                                    </td>
                                    <td class="p-4">
                                        <!-- Badge Status Pengaduan -->
                                        @if($aduan->status == 'Terkirim')
                                            <span class="px-2.5 py-1 rounded-md text-xs font-bold border bg-red-50 text-red-700 border-red-200">TERKIRIM</span>
                                        @elseif($aduan->status == 'Dibaca')
                                            <span class="px-2.5 py-1 rounded-md text-xs font-bold border bg-amber-50 text-amber-700 border-amber-200">DIBACA</span>
                                        @elseif($aduan->status == 'Diproses')
                                            <span class="px-2.5 py-1 rounded-md text-xs font-bold border bg-blue-50 text-blue-700 border-blue-200">DIPROSES</span>
                                        @elseif($aduan->status == 'Selesai')
                                            <span class="px-2.5 py-1 rounded-md text-xs font-bold border bg-green-50 text-green-700 border-green-200">SELESAI</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <!-- Tombol Detail Pengaduan -->
                                        <button onclick="openDetailModal('{{ $aduan->id }}', '{{ $aduan->nomor_tiket }}', '{{ $aduan->kategori }}', '{{ $aduan->pelapor ?: 'Anonim' }}', '{{ $aduan->created_at ? $aduan->created_at->translatedFormat('d F Y (H:i)') : '-' }}', '{{ $aduan->status }}', '{{ addslashes($aduan->deskripsi) }}', '{{ $aduan->foto_bukti ? asset('uploads/pengaduan/' . $aduan->foto_bukti) : '' }}')" 
                                                class="px-3 py-1.5 bg-green-50 text-green-700 hover:bg-green-100 border border-green-200 rounded-lg text-xs font-bold transition flex items-center gap-1 inline-flex cursor-pointer" title="Lihat Detail">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            <span>Lihat Detail</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center space-y-2">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            <p class="font-medium text-sm text-gray-500">Tidak ada pengaduan dengan status "{{ request('status') ?? 'Semua' }}".</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- JAVASCRIPT: Mengontrol Detail Modal Form & Komunikasi Aksi Laravel -->
    <script>
        // Membuka Modal Detail Pengaduan & Mengisi Data Secara Dinamis
        function openDetailModal(id, nomorTiket, kategori, pelapor, tanggal, status, deskripsi, fotoUrl) {
            document.getElementById('detail-tiket').textContent = nomorTiket;
            document.getElementById('detail-kategori').textContent = kategori;
            document.getElementById('detail-pelapor').textContent = pelapor;
            document.getElementById('detail-tanggal').textContent = tanggal;
            document.getElementById('detail-deskripsi').textContent = deskripsi;

            // Update Action Route pada form update status
            document.getElementById('update-status-form').action = "/admin/pengaduan/" + id + "/status";

            // Atur pilihan Select Option sesuai status saat ini
            document.getElementById('detail-select-status').value = status;

            // Membuat Badge Status di dalam Modal
            const badgeContainer = document.getElementById('detail-status-badge');
            let badgeHTML = '';
            if (status === 'Terkirim') {
                badgeHTML = '<span class="px-2.5 py-0.5 rounded text-xs font-bold border bg-red-50 text-red-700 border-red-200">TERKIRIM</span>';
            } else if (status === 'Dibaca') {
                badgeHTML = '<span class="px-2.5 py-0.5 rounded text-xs font-bold border bg-amber-50 text-amber-700 border-amber-200">DIBACA</span>';
            } else if (status === 'Diproses') {
                badgeHTML = '<span class="px-2.5 py-0.5 rounded text-xs font-bold border bg-blue-50 text-blue-700 border-blue-200">DIPROSES</span>';
            } else if (status === 'Selesai') {
                badgeHTML = '<span class="px-2.5 py-0.5 rounded text-xs font-bold border bg-green-50 text-green-700 border-green-200">SELESAI</span>';
            }
            badgeContainer.innerHTML = badgeHTML;

            // Kelola Thumbnail Bukti Gambar Makanan
            const imgElement = document.getElementById('detail-img');
            if (fotoUrl !== "") {
                imgElement.src = fotoUrl;
            } else {
                imgElement.src = "https://placehold.co/600x400/f3f4f6/9ca3af?text=Tidak+Ada+Foto+Bukti";
            }

            // Tampilkan Modal dengan Transisi Animasi
            const modal = document.getElementById('detail-modal');
            const container = document.getElementById('modal-container');
            modal.classList.remove('hidden');
            setTimeout(() => container.classList.remove('scale-95'), 10);
        }

        // Menutup Modal Detail
        function closeDetailModal() {
            const modal = document.getElementById('detail-modal');
            const container = document.getElementById('modal-container');
            container.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 150);
        }
    </script>
</body>
</html>