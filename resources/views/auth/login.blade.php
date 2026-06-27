<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pengguna - SPPG Cirendang</title>
    <!-- CDN Tailwind CSS v4 -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 font-sans antialiased flex h-screen w-screen overflow-hidden">

    <!-- BAGIAN KIRI: Background Gambar & Judul Web (Hanya tampil di Desktop/Tablet md ke atas) -->
    <div class="hidden md:flex md:w-1/2 h-full relative items-center justify-center bg-gray-900">
        <!-- Gambar Latar Belakang -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=1200&q=80" 
                 class="w-full h-full object-cover" 
                 alt="Latar Belakang Gizi SPPG">
            <!-- Overlay warna hijau gelap transparan yang premium -->
            <div class="absolute inset-0 bg-[#071E48]/80 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-transparent to-transparent opacity-90"></div>
        </div>

        <!-- Konten Overlay Identitas -->
        <div class="relative z-10 px-12 max-w-lg text-center md:text-left space-y-6">
            <div class="inline-flex p-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20">
                <!-- Logo SPPG dengan Fallback -->
                <img src="{{ asset('img/bgn_logo.png') }}" alt="Logo SPPG" class="w-12 h-12 object-contain">
            </div>
            <div class="space-y-3">
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-wide leading-tight">SPPG Cirendang</h1>
                <p class="text-sm text-[#D4B16D] leading-relaxed font-medium">
                    Satuan Pelayanan Pemenuhan Gizi Kokrosono. Menyediakan layanan pemenuhan makanan bergizi seimbang, higienis, dan sehat bagi generasi emas Indonesia.
                </p>
            </div>
            <div class="pt-4 flex items-center gap-2 text-xs text-green-300 font-semibold">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span>Program Makan Bergizi Gratis Terintegrasi</span>
            </div>
        </div>
    </div>

    <!-- BAGIAN KANAN: Formulir Login -->
    <div class="w-full md:w-1/2 h-full flex flex-col justify-center px-6 sm:px-12 lg:px-20 bg-white border-l border-white z-10">
        
        <div class="max-w-md w-full mx-auto space-y-8">
            <!-- Ucapan Selamat Datang -->
            <div class="space-y-2">
                <h2 class="text-2xl md:text-3xl font-black text-gray tracking-tight">Selamat Datang Kembali</h2>
                <p class="text-sm text-gray-500">Silakan masukkan username dan password Anda untuk masuk ke sistem.</p>
            </div>

            <!-- Menampilkan Alert Error Login (Jika Gagal) -->
            @if(session('error'))
                <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-semibold rounded-xl flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse shrink-0"></span>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-semibold rounded-xl">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulir Autentikasi -->
            <form method="POST" action="{{ route('login.proses') }}" class="space-y-5">
                @csrf
                
                <!-- Input Username -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Username / Nama Admin</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <input type="text" 
                               name="username" 
                               required 
                               value="{{ old('username') }}" 
                               placeholder="Masukkan username Anda" 
                               class="w-full bg-white border border-gray-800 rounded-xl py-3 pl-11 pr-4 text-sm text-gray placeholder-gray-500 focus:ring-2 focus:ring-[#071E48] focus:border-[#071E48] outline-none transition duration-200">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Kata Sandi / Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 6h.01M10 11h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2z"></path>
                            </svg>
                        </span>
                        <input type="password" 
                               name="password" 
                               required 
                               placeholder="Masukkan password Anda" 
                               class="w-full bg-white border border-gray-800 rounded-xl py-3 pl-11 pr-4 text-sm text-gray placeholder-gray-500 focus:ring-2 focus:ring-[#071E48] focus:border-[#071E48] outline-none transition duration-200">
                    </div>
                </div>

                <!-- Tombol Masuk Sekarang -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#071E48] hover:bg-[#0D2D69] text-white font-bold py-3 rounded-xl shadow-lg transition duration-200 text-sm flex items-center justify-center gap-2 cursor-pointer">
                        <span>Masuk Sekarang</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Tautan Kembali Ke Beranda -->
            <div class="text-center pt-4 border-t border-gray-900/60">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-[#071E48] font-medium transition duration-200 group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>

    </div>

</body>
</html>