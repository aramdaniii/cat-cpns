<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAT CPNS - Simulasi Tes CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        .fade-in-delay-1 {
            animation: fadeIn 0.8s ease-out 0.2s both;
        }
        .fade-in-delay-2 {
            animation: fadeIn 0.8s ease-out 0.4s both;
        }
    </style>
</head>
<body class="bg-slate-50/50 min-h-screen flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-100 rounded-full mix-blend-multiply filter blur-xl opacity-30"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-4xl">
        <div class="text-center mb-12 fade-in">
            <!-- Logo Section -->
            <div class="mb-8 float-animation">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl shadow-2xl mb-6">
                    <i class="fas fa-graduation-cap text-white text-4xl"></i>
                </div>
            </div>
            
            <h1 class="text-6xl font-bold text-slate-900 mb-4 tracking-tight">
                CAT CPNS
            </h1>
            <p class="text-xl text-slate-600 mb-8 max-w-2xl mx-auto">
                Platform simulasi tes CPNS modern dengan teknologi terkini untuk persiapan seleksi Anda
            </p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-3xl shadow-[0_20px_25px_-5px_rgba(0,0,0,0.1),0_10px_10px_-5px_rgba(0,0,0,0.04)] border border-slate-100 p-8 md:p-12 fade-in-delay-1">
            @guest
                <!-- Guest Content -->
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-slate-800 mb-8">Selamat Datang di CAT CPNS</h2>
                    
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-sign-in-alt text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Masuk Akun</h3>
                            <p class="text-slate-600 mb-4">Akses dashboard Anda dan lanjutkan tes</p>
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg w-full">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Masuk
                            </a>
                        </div>
                        
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-user-plus text-emerald-600 text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Daftar Baru</h3>
                            <p class="text-slate-600 mb-4">Buat akun baru untuk memulai tes</p>
                            <a href="{{ route('register') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg w-full">
                                <i class="fas fa-user-plus mr-2"></i>
                                Daftar
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Authenticated Content -->
                <div class="text-center">
                    <div class="mb-8">
                        <div class="inline-flex items-center space-x-3 bg-slate-50 rounded-2xl px-6 py-3 border border-slate-100">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-sm text-slate-500">Selamat datang kembali,</p>
                                <p class="font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                            </div>
                            @if(auth()->user()->isAdmin())
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-rose-50 text-rose-700">
                                    <i class="fas fa-shield-alt mr-1"></i>
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    <i class="fas fa-user mr-1"></i>
                                    User
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        @if(auth()->user()->isAdmin())
                            <div class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-2xl p-6 border border-slate-200">
                                <div class="w-12 h-12 bg-slate-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-shield-alt text-white text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Dashboard Admin</h3>
                                <p class="text-slate-600 mb-4">Kelola sistem dan pantau aktivitas</p>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-slate-600 to-slate-700 text-white font-medium rounded-xl hover:from-slate-700 hover:to-slate-800 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg w-full">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Dashboard Admin
                                </a>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-slate-900 mb-2">Dashboard User</h3>
                                <p class="text-slate-600 mb-4">Akses tes dan lihat riwayat Anda</p>
                                <a href="{{ route('dashboard') }}" 
                                   class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg w-full">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Dashboard User
                                </a>
                            </div>
                        @endif
                        
                        <div class="bg-gradient-to-r from-red-50 to-rose-50 rounded-2xl p-6 border border-red-200">
                            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-sign-out-alt text-white text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Keluar</h3>
                            <p class="text-slate-600 mb-4">Keluar dari sistem dengan aman</p>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 text-white font-medium rounded-xl hover:from-red-600 hover:to-rose-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg w-full">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endguest
        </div>

        <!-- Features Section -->
        <div class="mt-12 grid md:grid-cols-3 gap-6 fade-in-delay-2">
            <div class="bg-white/80 backdrop-blur rounded-2xl p-6 border border-slate-100 text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-semibold text-slate-900 mb-2">Timer Real-time</h3>
                <p class="text-sm text-slate-600">Sistem timer akurat untuk setiap soal</p>
            </div>
            
            <div class="bg-white/80 backdrop-blur rounded-2xl p-6 border border-slate-100 text-center">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-emerald-600 text-xl"></i>
                </div>
                <h3 class="font-semibold text-slate-900 mb-2">Analisis Hasil</h3>
                <p class="text-sm text-slate-600">Lihat performa dan statistik Anda</p>
            </div>
            
            <div class="bg-white/80 backdrop-blur rounded-2xl p-6 border border-slate-100 text-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-purple-600 text-xl"></i>
                </div>
                <h3 class="font-semibold text-slate-900 mb-2">Responsive Design</h3>
                <p class="text-sm text-slate-600">Akses dari berbagai perangkat</p>
            </div>
        </div>
    </div>
</body>
</html>
