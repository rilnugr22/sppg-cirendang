<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tim SPPG - SPPG Kokrosono</title>
    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased flex h-screen overflow-hidden">

    <!-- MODAL FORM (Tambah & Edit Tim MySQL) -->
    <div id="tim-modal" class="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4 transition-all duration-300">
        <div class="bg-white rounded-2xl border border-gray-100 w-full max-w-md p-6 shadow-xl transform scale-95 transition-all duration-300" id="modal-container">
            <div class="flex justify-between items-center mb-4">
                <h3 id="modal-title" class="text-lg font-bold text-gray-900">Tambah Anggota Tim</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form id="modal-form" method="POST" action="{{ route('admin.tim.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div id="method-container"></div> <!-- Berisi input @method('PUT') secara dinamis saat edit -->
                
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                    <input type="text" name="nama" id="input-nama" required placeholder="Masukkan nama lengkap" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#071E48] focus:border-[#071E48] outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Jabatan / Peran *</label>
                    <input type="text" name="jabatan" id="input-jabatan" required placeholder="Contoh: Ahli Gizi, Juru Masak" class="w-full border border-gray-200 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-[#071E48] focus:border-[#071E48] outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1.5">Foto Anggota</label>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full bg-gray-100 border border-gray-200 overflow-hidden flex items-center justify-center shrink-0">
                            <img id="img-preview" src="https://placehold.co/150x150/f3f4f6/9ca3af?text=Avatar" class="w-full h-full object-cover">
                        </div>
                        <input type="file" name="foto" id="input-foto" onchange="previewImage(event)" accept="image/*" class="w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#B5CFFE] file:text-[#071E48] hover:file:bg-[#2860C6] transition cursor-pointer">
                    </div>
                    <p id="foto-help" class="text-[10px] text-gray-400 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
                </div>
                
                <div class="flex gap-3 justify-end pt-4 border-t border-gray-100">
                    <button type="button" onclick="closeModal()" class="px-4 py-2.5 text-sm font-semibold text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-[#071E48] hover:bg-[#0D2D69] rounded-lg shadow-sm transition">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL KONFIRMASI HAPUS (Custom Delete Modal) -->
    <div id="delete-modal" class="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center hidden z-50 p-4 transition-all duration-300">
        <div class="bg-white rounded-2xl border border-gray-100 w-full max-w-sm p-6 shadow-xl transform scale-95 transition-all duration-300" id="delete-modal-container">
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full bg-red-50 text-red-500 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Hapus Anggota Tim?</h3>
                <p class="text-sm text-gray-500 mb-6">Tindakan ini tidak dapat dibatalkan. Anggota tim <strong id="delete-target-name" class="text-gray-950"></strong> akan dihapus permanen dari MySQL.</p>
                
                <form id="delete-form" method="POST" action="" class="w-full flex gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2.5 text-sm font-semibold text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition border border-gray-200">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition">Ya, Hapus</button>
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
                    <!-- Dashboard Link -->
                    <a href="dashboard" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        Dashboard
                    </a>

                    <!-- Users Link -->
                    <a href="users" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Users
                    </a>

                    <!-- Sekolah Link -->
                    <a href="sekolah" class="flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-400 hover:bg-gray-900/50 hover:text-white transition border-l-4 border-transparent hover:border-[#D4B16D]/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Sekolah
                    </a>

                    <!-- Tim SPPG Link (ACTIVE STATE) -->
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-sm font-semibold bg-gray-900 border-l-4 border-[#D4B16D] text-white transition">
                        <svg class="w-5 h-5 text-[#D4B16D]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
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

    <!-- Area Konten Utama Dashboard (Kanan) -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- Header Atas Panel Admin -->
        <header class="bg-white shadow-xs h-16 flex items-center justify-between px-6 border-b border-gray-200 shrink-0">
            <h1 class="text-lg font-bold text-gray-900">Kelola Anggota Tim SPPG</h1>
            <div class="text-xs font-semibold text-gray-600 bg-gray-100 px-3 py-2 rounded-lg border border-gray-200 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                <span>Hari ini: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
            </div>
        </header>

        <!-- Bagian Canvas Utama Scrollable -->
        <main class="flex-1 overflow-y-auto p-6 space-y-6">
            
            <!-- Toolbar & Filter Area -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <!-- Input Pencarian Real-Time (Sisi Client) -->
                <div class="relative w-full md:max-w-xs">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" id="search-input" oninput="searchTim()" placeholder="Cari nama staff..." class="w-full bg-white border border-gray-200 rounded-xl py-2.5 pl-10 pr-4 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition shadow-xs">
                </div>

                <!-- Tombol Tambah Tim -->
                <button onclick="openAddModal()" class="inline-flex items-center justify-center gap-2 bg-[#071E48] hover:bg-[#0D2D69] text-white font-bold py-2.5 px-5 rounded-xl shadow-xs transition duration-200 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span>Tambah Anggota</span>
                </button>
            </div>

            <!-- Pesan Sukses / Error Laravel Session -->
            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-800 text-sm font-semibold rounded-xl flex items-center gap-2 shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 text-red-800 text-sm font-semibold rounded-xl shadow-xs">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tabel Data Tim dari MySQL -->
            <div class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden">
                <div class="p-4 border-b border-gray-200 bg-gray-50 font-bold text-gray-700 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
                        <span>Struktur Organisasi Pelayanan Gizi</span>
                    </div>
                    <span class="text-xs bg-gray-200 text-gray-700 px-2.5 py-1 rounded-md" id="tim-count">Total: {{ $allTim->count() }}</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="tim-table">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-200">
                                <th class="p-4 font-semibold w-16">No</th>
                                <th class="p-4 font-semibold w-24">Foto</th>
                                <th class="p-4 font-semibold">Nama Lengkap</th>
                                <th class="p-4 font-semibold">Jabatan / Peran</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allTim as $index => $tim)
                                <tr class="tim-row border-b border-gray-200 hover:bg-gray-50/50 text-sm text-gray-700 transition">
                                    <td class="p-4 font-semibold text-gray-500">{{ $index + 1 }}</td>
                                    <td class="p-4">
                                        <div class="w-10 h-10 rounded-full border border-gray-200 overflow-hidden bg-gray-100 flex items-center justify-center shrink-0">
                                            @if($tim->foto)
                                                <img src="{{ asset('uploads/tim/' . $tim->foto) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="font-bold text-sm text-green-600">{{ substr($tim->nama, 0, 1) }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="p-4 font-bold text-gray-900 tim-name-text">{{ $tim->nama }}</td>
                                    <td class="p-4 text-gray-600">{{ $tim->jabatan }}</td>
                                    <td class="p-4 text-right">
                                        <div class="inline-flex gap-2">
                                            <!-- Tombol Edit -->
                                            <button onclick="openEditModal('{{ $tim->id }}', '{{ addslashes($tim->nama) }}', '{{ addslashes($tim->jabatan) }}', '{{ $tim->foto ? asset('uploads/tim/' . $tim->foto) : '' }}')" class="p-1.5 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg border border-yellow-200 transition" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            
                                            <!-- Tombol Hapus -->
                                            <button onclick="openDeleteModal('{{ $tim->id }}', '{{ addslashes($tim->nama) }}')" class="p-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg border border-red-200 transition" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center space-y-2">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <p class="font-medium text-sm text-gray-500">Tidak ada anggota tim terdaftar di MySQL.</p>
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

    <!-- JAVASCRIPT: Mengontrol Modal Form & Komunikasi Aksi Laravel -->
    <script>
        // Logika Menampilkan Thumbnail Gambar saat Memilih File Foto di Input File
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "https://placehold.co/150x150/f3f4f6/9ca3af?text=Avatar";
            }
        }

        // Buka Modal Tambah Anggota Tim Baru
        function openAddModal() {
            document.getElementById('modal-title').textContent = "Tambah Anggota Tim";
            document.getElementById('modal-form').reset();
            document.getElementById('modal-form').action = "{{ route('admin.tim.store') }}";
            document.getElementById('method-container').innerHTML = ""; // Bersihkan method PUT
            document.getElementById('img-preview').src = "https://placehold.co/150x150/f3f4f6/9ca3af?text=Avatar";

            const modal = document.getElementById('tim-modal');
            const container = document.getElementById('modal-container');
            modal.classList.remove('hidden');
            setTimeout(() => container.classList.remove('scale-95'), 10);
        }

        // Buka Modal Edit Anggota Tim
        function openEditModal(id, nama, jabatan, fotoUrl) {
            document.getElementById('modal-title').textContent = "Edit Data Anggota Tim";
            document.getElementById('input-nama').value = nama;
            document.getElementById('input-jabatan').value = jabatan;
            
            // Set Thumbnail Foto lama jika ada, jika tidak pasang default avatar letter
            if (fotoUrl !== "") {
                document.getElementById('img-preview').src = fotoUrl;
            } else {
                document.getElementById('img-preview').src = "https://placehold.co/150x150/f3f4f6/9ca3af?text=" + nama.charAt(0);
            }
            
            // Atur URL Action dinamis untuk Update data berdasarkan ID Anggota Tim
            document.getElementById('modal-form').action = "/admin/tim/" + id;
            document.getElementById('method-container').innerHTML = '@csrf @method("PUT")';

            const modal = document.getElementById('tim-modal');
            const container = document.getElementById('modal-container');
            modal.classList.remove('hidden');
            setTimeout(() => container.classList.remove('scale-95'), 10);
        }

        // Tutup Modal Form
        function closeModal() {
            const modal = document.getElementById('tim-modal');
            const container = document.getElementById('modal-container');
            container.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 150);
        }

        // Buka Modal Konfirmasi Hapus
        function openDeleteModal(id, nama) {
            document.getElementById('delete-target-name').textContent = nama;
            // Atur URL Action dinamis untuk menghapus data berdasarkan ID Anggota Tim
            document.getElementById('delete-form').action = "/admin/tim/" + id;
            
            const modal = document.getElementById('delete-modal');
            const container = document.getElementById('delete-modal-container');
            modal.classList.remove('hidden');
            setTimeout(() => container.classList.remove('scale-95'), 10);
        }

        // Tutup Modal Konfirmasi Hapus
        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            const container = document.getElementById('delete-modal-container');
            container.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 150);
        }

        // Pencarian Real-Time Sisi Client
        function searchTim() {
            const query = document.getElementById('search-input').value.toLowerCase();
            const rows = document.querySelectorAll('.tim-row');
            
            rows.forEach(row => {
                const nameText = row.querySelector('.tim-name-text').textContent.toLowerCase();
                if (nameText.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>