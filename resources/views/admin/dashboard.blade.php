<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - SPPG Kokrosono</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans antialiased flex h-screen">

    <div class="w-64 bg-gray-950 text-white flex flex-col shrink-0 hidden md:flex border-r border-gray-900">
        <!-- Brand Logo Area (Menggunakan tag IMG menggantikan SVG) -->
        <div class="p-5 font-bold text-lg border-b border-gray-900 flex items-center gap-3">
            <img src="{{ asset('img/bgn_logo.png') }}" alt="Logo SPPG" class="w-8 h-8 object-contain rounded-md">
            <span class="text-[#D4B16D] tracking-wide font-extrabold text-xl">SPPG Admin</span>
        </div>
         <!-- Menu Items List (Daftar Menu Navigasi Samping) -->
        <div class="flex-1 py-6 space-y-7 overflow-y-auto">
            
            <!-- Kategori 1: Menu Utama -->
            <div>
                <p class="px-5 text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Menu Utama</p>
                <div class="space-y-1">
                    <!-- Dashboard Link -->
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-sm font-semibold bg-gray-900 border-l-4 border-[#D4B16D] text-white transition">
                        <svg class="w-5 h-5 text-[#D4B16D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        Dashboard
                    </a>

                    <!-- Users Link  -->
                    <a href="users" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5"  fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Users
                    </a>

                    <!-- Sekolah Link -->
                    <a href="sekolah" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Sekolah
                    </a>

                    <!-- Tim SPPG Link -->
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
                    <!-- Edukasi Link -->
                    <a href="edukasi" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Edukasi
                    </a>

                    <!-- Menu Gizi Link -->
                    <a href="menu-gizi" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menu Gizi
                    </a>
                    <a href="pengaduan" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
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

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6">
            <h1 class="text-xl font-bold text-gray-800">Ringkasan Sistem & Pengaduan</h1>
            <div class="text-sm font-medium text-gray-600 bg-gray-100 px-3 py-1.5 rounded">
                Hari ini: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-6 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Total Users</span>
                    <span class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers }}</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Sekolah MBG</span>
                    <span class="text-3xl font-bold text-gray-800 mt-1">{{ $totalSekolah }}</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Tim SPPG</span>
                    <span class="text-3xl font-bold text-gray-800 mt-1">{{ $totalTim }}</span>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col">
                    <span class="text-sm font-medium text-gray-500">Total Pengaduan</span>
                    <span class="text-3xl font-bold text-gray-800 mt-1">{{ $totalPengaduan }}</span>
                </div>
            </div>

            <div class="bg-red-50 p-6 rounded-xl border border-red-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-red-800">Persentase Masalah Keterlambatan</h3>
                    <p class="text-sm text-red-600 mt-1">Rasio aduan keterlambatan distribusi terhadap total aduan masuk harian.</p>
                </div>
                <div class="text-4xl font-black text-red-600">
                    {{ $persentaseKeterlambatan }}%
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200 bg-gray-50 font-bold text-gray-700">
                    Daftar Pengaduan Masyarakat Terkini
                </div>
                
                @if(session('success'))
                    <div class="m-4 p-3 bg-green-100 text-green-800 text-sm font-medium rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider border-b">
                                <th class="p-4 font-medium">Nomor Tiket</th>
                                <th class="p-4 font-medium">Kategori</th>
                                <th class="p-4 font-medium">Isi Deskripsi</th>
                                <th class="p-4 font-medium">Pelapor</th>
                                <th class="p-4 font-medium">Status Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengaduanTerbaru as $aduan)
                                <tr class="border-b hover:bg-gray-50 text-sm text-gray-700">
                                    <td class="p-4 font-bold text-gray-900">{{ $aduan->nomor_tiket }}</td>
                                    <td class="p-4"><span class="bg-gray-100 px-2 py-1 rounded text-xs font-semibold">{{ $aduan->kategori }}</span></td>
                                    <td class="p-4 max-w-xs truncate">{{ $aduan->deskripsi }}</td>
                                    <td class="p-4 text-gray-500">{{ $aduan->pelapor }}</td>
                                    <td class="p-4">
                                        <form action="{{ route('admin.pengaduan.updateStatus', $aduan->id) }}" method="POST" ...>
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="this.form.submit()" class="text-xs font-bold px-2 py-1.5 rounded border outline-none cursor-pointer
                                                {{ $aduan->status == 'Terkirim' ? 'bg-red-100 text-red-700 border-red-200' : '' }}
                                                {{ $aduan->status == 'Diproses' ? 'bg-blue-100 text-blue-700 border-blue-200' : '' }}
                                                {{ $aduan->status == 'Selesai' ? 'bg-green-100 text-green-700 border-green-200' : '' }}
                                            ">
                                                <option value="Terkirim" {{ $aduan->status == 'Terkirim' ? 'selected' : '' }}>TERKIRIM</option>
                                                <option value="Diproses" {{ $aduan->status == 'Diproses' ? 'selected' : '' }}>DIPROSES</option>
                                                <option value="Selesai" {{ $aduan->status == 'Selesai' ? 'selected' : '' }}>SELESAI</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500">Belum ada data pengaduan masuk.</td>
                                    <p class="text-gray-500">Pastikan database anda telah terisi data tiruan atau lewat form publik.</p>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>