<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPPG Cirendang - Program Makan Bergizi Gratis</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <nav class="fixed w-full bg-[#B5E0E9] shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/bgn_logo.png') }}" alt="Logo SPPG" class="w-9 h-9 object-contain transition-transform duration-300 hover:scale-110">
                    <span class="font-bold text-xl tracking-tight text-[#071E48]">SPPG Cirendang</span>
                </div>
                <div class="hidden md:flex space-x-6 text-sm font-medium items-center">
                    <a href="#beranda" class="nav-link text-gray-600 hover:text-[#071E48] transition h-9 flex items-center">Beranda</a>
                    <a href="#menu" class="nav-link text-gray-600 hover:text-[#071E48] transition h-9 flex items-center">Menu</a>
                    <a href="#tim" class="nav-link text-gray-600 hover:text-[#071E48] transition h-9 flex items-center">Tim</a>
                    <a href="#pengaduan" class="nav-link text-gray-600 hover:text-[#071E48] transition h-9 flex items-center">Pengaduan</a>
                    <a href="#edukasi" class="nav-link text-gray-600 hover:text-[#071E48] transition h-9 flex items-center">Edukasi</a>
                    <a href="{{ route('admin.dashboard') }}" class="bg-[#071E48] hover:bg-[#0D2D69] text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-200">➔ Login Staff</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="pt-16">
        <div class="relative bg-gray-900 h-[60vh] flex items-center justify-center text-center">
            <div class="absolute inset-0 overflow-hidden opacity-40">
                <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover" alt="Banner Gizi">
            </div>
            <div class="relative z-10 px-4 max-w-4xl mx-auto text-white">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Gizi Seimbang untuk Generasi Emas</h1>
                <p class="text-lg text-gray-200 mb-8">Sistem Informasi Satuan Pelayanan Pemenuhan Gizi Program Makan Bergizi Gratis (SPPG Cirendang).</p>
                <a href="#menu" class="bg-[#071E48] hover:bg-[#0D2D69] text-white font-bold py-3 px-8 rounded-full shadow-lg transition">Lihat Menu Hari Ini</a>
            </div>
        </div>
    </section>

    <section id="menu" class="py-16 max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold">Riwayat Menu</h2>
            <p class="text-gray-500 mt-2">Arsip menu makanan bergizi yang telah disajikan.</p>
        </div>

        <form action="{{ route('home') }}" method="GET" class="bg-white p-6 rounded-xl border shadow-sm mb-8 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full border rounded-md p-2 focus:ring-green-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sekolah</label>
                <select name="sekolah_id" class="w-full border rounded-md p-2 focus:ring-green-500">
                    <option value="Semua Sekolah">Semua Sekolah</option>
                    @foreach($allSekolah as $sekolah)
                        <option value="{{ $sekolah->id }}" {{ request('sekolah_id') == $sekolah->id ? 'selected' : '' }}>{{ $sekolah->nama_sekolah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <button type="submit" class="w-full bg-[#071E48] text-white font-bold p-2 rounded-md hover:bg-[#0D2D69] transition">Cari Menu</button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($daftarMenu as $menu)
                <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
                    <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                        @if($menu->foto_menu)
                            <img src="{{ asset('uploads/menu/'.$menu->foto_menu) }}" class="w-full h-full object-cover">
                        @else
                            <span class="font-medium">No Image</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-gray-900">{{ $menu->nama_menu }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($menu->tanggal)->translatedFormat('d F Y') }} • {{ $menu->sekolah->nama_sekolah }}</p>
                        <div class="mt-3 pt-3 border-t grid grid-cols-4 text-center text-xs text-gray-600 bg-gray-50 p-2 rounded">
                            <div><span class="block font-bold text-green-600">{{ $menu->kalori }}</span>Kalori</div>
                            <div><span class="block font-bold text-green-600">{{ $menu->protein }}</span>Prot</div>
                            <div><span class="block font-bold text-green-600">{{ $menu->lemak }}</span>Lemak</div>
                            <div><span class="block font-bold text-green-600">{{ $menu->karbohidrat }}</span>Karbo</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500 border border-dashed rounded-xl">Tidak ada menu makanan ditemukan untuk filter ini.</div>
            @endforelse
        </div>
    </section>

    <section id="tim" class="py-16 bg-gray-100 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-2">Tim SPPG Cirendang</h2>
            <p class="text-gray-500 mb-12">Orang-orang berdedikasi di balik penyediaan makanan bergizi.</p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($allTim as $tim)
                    <div class="flex flex-col items-center bg-white p-4 rounded-xl shadow-sm border">
                        <div class="w-24 h-24 rounded-full bg-[#B5CFFE] flex items-center justify-center text-[#0D2D69] text-2xl font-bold mb-4 overflow-hidden">
                            {{ substr($tim->nama, 0, 1) }}
                        </div>
                        <h3 class="font-bold text-md text-gray-900">{{ $tim->nama }}</h3>
                        <p class="text-xs text-gray-500">{{ $tim->jabatan }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="pengaduan" class="py-16 max-w-3xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold">Formulir Pengaduan</h2>
            <p class="text-gray-500 mt-2">Laporkan jika ada kendala porsi, keterlambatan, atau kualitas makanan.</p>
        </div>

        @if(session('success_tiket'))
            <div class="bg-green-50 border border-green-200 text-center rounded-xl p-6 mb-6">
                <h3 class="text-xl font-bold text-green-800 mb-1">Pengaduan berhasil dikirim!</h3>
                <p class="text-gray-700">Nomor Tiket Anda: <strong class="text-black bg-yellow-200 px-2 py-0.5 rounded">{{ session('success_tiket') }}</strong></p>
                <p class="text-xs text-gray-500 mt-2">Simpan nomor tiket ini untuk memantau status tindak lanjut.</p>
            </div>
        @endif

        <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Masalah *</label>
                    <select name="kategori" required class="w-full border rounded-md p-2">
                        <option value="Porsi">Porsi Kurang / Sedikit</option>
                        <option value="Keterlambatan">Keterlambatan Distribusi</option>
                        <option value="Kualitas Makanan">Kualitas Makanan (Basi/Kurang Matang)</option>
                        <option value="Higienitas">Higienitas</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Masalah *</label>
                    <textarea name="deskripsi" required rows="4" placeholder="Tuliskan keluhan Anda secara mendetail..." class="w-full border rounded-md p-2"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti (Opsional)</label>
                    <input type="file" name="foto_bukti" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#B5CFFE] file:text-[#071E48] hover:file:bg-[#2860C6]">
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="anonim" id="anonim" value="1" class="rounded text-green-600">
                    <label htmlFor="anonim" class="ml-2 text-sm text-gray-600">Kirim aduan sebagai Anonim</label>
                </div>
                <button type="submit" class="w-full bg-[#071E48] text-white font-bold py-3 rounded-md hover:bg-[#0D2D69]  transition">Kirim Aduan Masyarakat</button>
            </form>
        </div>
    </section>

    <!-- Section: Edukasi Gizi -->
    <section id="edukasi" class="py-16 bg-gray-50 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold">Edukasi Gizi Sehat</h2>
            <p class="text-gray-500 mt-2">Dapatkan wawasan seputar pola makan seimbang dan nutrisi penting bagi tumbuh kembang.</p>
        </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($allEdukasi as $edukasi)
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-md transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative h-48 bg-gray-200">
                            <img src="{{ $edukasi->tipe == 'Video' ? 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?auto=format&fit=crop&w=600&q=80' : 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=600&q=80' }}" 
                                 alt="{{ $edukasi->judul }}" 
                                 class="w-full h-full object-cover">
                            
                            <span class="absolute top-3 left-3 text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-md shadow-xs
                                {{ $edukasi->tipe == 'Video' ? 'bg-red-600 text-white' : 'bg-[#0D2D69] text-white' }}">
                                {{ $edukasi->tipe }}
                            </span>
                        </div>

                        <div class="p-6">
                            <p class="text-xs text-gray-400 mb-2">
                                Diterbitkan: {{ \Carbon\Carbon::parse($edukasi->tanggal_publish)->translatedFormat('d F Y') }}
                            </p>
                            <h3 class="font-bold text-xl text-gray-900 mb-3 leading-snug">{{ $edukasi->judul }}</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ Str::limit($edukasi->konten, 120, '...') }}</p>
                        </div>
                    </div>
                    
                    <div class="p-6 pt-0 mt-auto">
                        <a href="#" class="inline-flex items-center text-sm font-bold text-[#071E48] hover:text-[#0D2D69] gap-1 mt-2">
                            {{ $edukasi->tipe == 'Video' ? 'Tonton Video' : 'Baca Selengkapnya' }} ➔
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500 border border-dashed rounded-xl">Belum ada artikel atau video edukasi gizi yang diterbitkan.</div>
            @endforelse
        </div>
    </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 pt-16 pb-8 border-t border-gray-800 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Kolom 1: Profil Singkat dengan Logo Selaras -->
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/bgn_logo.png') }}" alt="Logo SPPG" class="w-9 h-9 object-contain transition-transform duration-300 hover:scale-110">
                    <span class="font-bold text-xl tracking-tight text-[#D4B16D]">SPPG Cirendang</span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Satuan Pelayanan Pemenuhan Gizi (SPPG) Cirendang berkomitmen menyediakan makanan bergizi seimbang, sehat, dan higienis demi mendukung tumbuh kembang generasi penerus bangsa.
                </p>
            </div>

            <!-- Kolom 2: Navigasi Cepat -->
            <div>
                <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="#beranda" class="hover:text-[#D4B16D] transition">Beranda</a></li>
                    <li><a href="#menu" class="hover:text-[#D4B16D] transition">Menu Makanan</a></li>
                    <li><a href="#tim" class="hover:text-[#D4B16D] transition">Tim Kami</a></li>
                    <li><a href="#pengaduan" class="hover:text-[#D4B16D] transition">Kirim Pengaduan</a></li>
                    <li><a href="#edukasi" class="hover:text-[#D4B16D] transition">Edukasi Gizi</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Informasi Kontak -->
            <div>
                <h4 class="text-white font-semibold mb-4">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-[#D4B16D] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Cirendang, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat 45518</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4B16D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>(024) 123-4567</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#D4B16D] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>info@sppgcirendang.go.id</span>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Jaminan Kualitas -->
            <div>
                <h4 class="text-white font-semibold mb-4">Program Terkait</h4>
                <p class="text-sm text-gray-400 mb-4 leading-relaxed">
                    Bagian dari aksi nasional percepatan pemenuhan gizi untuk mewujudkan generasi unggul masa depan.
                </p>
                <div class="inline-flex items-center gap-2 bg-gray-800 px-3.5 py-2 rounded-lg border border-gray-700">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-xs font-semibold text-gray-200">Gizi Terjamin & Higienis</span>
                </div>
            </div>
        </div>

        <!-- Bagian Hak Cipta -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-6 border-t border-gray-800 text-center text-xs text-gray-500 flex flex-col md:flex-row justify-between gap-4">
            <p>&copy; 2026 SPPG Cirendang. Hak Cipta Dilindungi Undang-Undang.</p>
            <p>Sistem Pelayanan Gizi Indonesia</p>
        </div>
    </footer>

</body>
</html>
