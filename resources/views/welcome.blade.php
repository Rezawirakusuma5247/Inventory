<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Inventory System') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="antialiased font-['figtree'] bg-slate-50">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="p-2 bg-indigo-600 rounded-lg">
                        <i class="ph-fill ph-package text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-extrabold text-slate-800 tracking-tight uppercase">{{ config('app.name') }}</span>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-full transition-all duration-300 shadow-md shadow-indigo-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Log in</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-32 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest text-indigo-600 uppercase bg-indigo-50 rounded-full">
                    Sistem Inventaris Modern
                </span>
                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                    Kelola Stok Barang Lebih <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">Mudah & Cepat</span>
                </h1>
                <p class="text-lg text-slate-600 mb-10 leading-relaxed">
                    Solusi terintegrasi untuk mencatat barang masuk, keluar, hingga opname stok secara real-time. Pantau semua aktivitas inventaris dalam satu dashboard.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition-all shadow-xl hover:-translate-y-1">
                        Mulai Sekarang
                    </a>
                    <a href="#features" class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-xl font-bold hover:bg-slate-50 transition-all">
                        Pelajari Fitur
                    </a>
                </div>
            </div>

            <!-- Mockup Preview -->
<!-- Mockup Preview -->
            <div class="relative max-w-5xl mx-auto">
                <!-- Efek Glow di Belakang Gambar -->
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur opacity-20"></div>

                <div class="relative bg-white border border-slate-200 rounded-2xl shadow-2xl overflow-hidden p-2">
                    <div class="bg-slate-100 rounded-xl overflow-hidden aspect-video">
                        <!-- Ganti Src sesuai lokasi file kamu, contoh: public/img/preview.png -->
                        <img
                            src="{{ asset('preview.png') }}"
                            alt="Dashboard Preview"
                            class="w-full h-full object-cover object-top shadow-inner"
                        >
                    </div>
                </div>

                <!-- Hiasan Tambahan: Floating Element (Opsional) -->
                <div class="absolute -bottom-6 -right-6 hidden md:block">
                    <div class="bg-white p-4 rounded-xl shadow-xl border border-slate-100 flex items-center gap-3 animate-bounce">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                            <i class="ph-fill ph-check-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-medium">Sistem Stabil</p>
                            <p class="text-sm font-bold text-slate-800">100% Terverifikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition-all group">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                        <i class="ph-fill ph-lightning text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Manajemen Real-time</h3>
                    <p class="text-slate-600">Pantau stok barang masuk dan keluar di saat itu juga tanpa perlu refresh data manual.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition-all group">
                    <div class="w-12 h-12 bg-violet-100 text-violet-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-violet-600 group-hover:text-white transition-all">
                        <i class="ph-fill ph-file-text text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Laporan Otomatis</h3>
                    <p class="text-slate-600">Dapatkan riwayat transaksi lengkap yang siap di-export ke Excel kapan saja untuk kebutuhan audit.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-indigo-200 transition-all group">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                        <i class="ph-fill ph-shield-check text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Hak Akses Ketat</h3>
                    <p class="text-slate-600">Keamanan data terjamin dengan pembagian peran (Admin, Manager, Staff) yang terintegrasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Built For Management Warehouse.
            </p>
        </div>
    </footer>

</body>
</html>
