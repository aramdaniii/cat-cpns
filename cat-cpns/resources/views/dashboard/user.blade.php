<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CAT CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        .fade-in-delay-1 {
            animation: fadeIn 0.6s ease-out 0.1s both;
        }
        .fade-in-delay-2 {
            animation: fadeIn 0.6s ease-out 0.2s both;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Modern Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">CAT CPNS</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        Dashboard
                    </a>
                    <a href="{{ route('test.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        Tes
                    </a>
                    <a href="{{ route('certificates.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        Sertifikat
                    </a>
                    <a href="{{ route('riwayat.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">
                        Riwayat
                    </a>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-gray-600 text-sm"></i>
                        </div>
                        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('test.index') }}" class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-clipboard-list mr-2"></i> Tes
                    </a>
                    <a href="{{ route('certificates.index') }}" class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-certificate mr-2"></i> Sertifikat
                    </a>
                    <a href="{{ route('riwayat.index') }}" class="text-gray-600 hover:text-gray-900 hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-history mr-2"></i> Riwayat
                    </a>

                    <div class="border-t border-gray-200 pt-3 mt-3">
                        <div class="flex items-center space-x-2 px-3 py-2">
                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-600 text-sm"></i>
                            </div>
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="px-3">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800 hover:bg-red-50 px-3 py-2 rounded-lg transition-colors duration-200 w-full text-left">
                                <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Toggle Script -->
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Section -->
        <div class="fade-in mb-12">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-100">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="mb-6 lg:mb-0 lg:mr-8">
                        <h1 class="text-4xl font-bold text-gray-900 mb-3">
                            Selamat Datang di <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">CAT CPNS</span>
                        </h1>
                        <p class="text-lg text-gray-600 max-w-2xl">
                            Platform simulasi tes CPNS modern yang dirancang untuk membantu Anda mempersiapkan diri dengan cara yang efektif dan interaktif.
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('test.index') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                            <i class="fas fa-play"></i>
                            <span>Mulai Tes CAT</span>
                        </a>
                        <a href="{{ route('riwayat.index') }}" 
                           class="px-6 py-3 bg-white border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transform hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                            <i class="fas fa-history"></i>
                            <span>Lihat Riwayat Tes</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Cards -->
        <div class="fade-in-delay-1">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Kategori Tes</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- TWK Card -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-2xl mb-4 mx-auto">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">TWK</h3>
                        <p class="text-gray-600 text-center mb-4">Tes Wawasan Kebangsaan</p>
                        <div class="flex items-center justify-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                Siap
                            </span>
                        </div>
                    </div>
                </div>

                <!-- TIU Card -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-amber-100 rounded-2xl mb-4 mx-auto">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">TIU</h3>
                        <p class="text-gray-600 text-center mb-4">Tes Intelegensi Umum</p>
                        <div class="flex items-center justify-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                Siap
                            </span>
                        </div>
                    </div>
                </div>

                <!-- TKP Card -->
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 border border-gray-100">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-16 h-16 bg-cyan-100 rounded-2xl mb-4 mx-auto">
                            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 text-center mb-2">TKP</h3>
                        <p class="text-gray-600 text-center mb-4">Tes Karakteristik Pribadi</p>
                        <div class="flex items-center justify-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                                    <circle cx="4" cy="4" r="3"></circle>
                                </svg>
                                Siap
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Analytics Card -->
        @if($twkCount > 0 || $tiuCount > 0 || $tkpCount > 0)
        <div class="fade-in-delay-2 mt-12">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                    Analisis Performa Anda
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Progress Bars -->
                    <div class="space-y-6">
                        <!-- TWK Progress Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">TWK (Tes Wawasan Kebangsaan)</span>
                                <span class="text-sm font-medium {{ $skorTWK >= 80 ? 'text-green-600' : ($skorTWK >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $skorTWK }}%
                                </span>
                            </div>
                            <div class="h-4 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 {{ $skorTWK >= 80 ? 'bg-gradient-to-r from-green-500 to-emerald-600' : ($skorTWK >= 60 ? 'bg-gradient-to-r from-yellow-400 to-amber-500' : 'bg-gradient-to-r from-red-500 to-rose-600') }}"
                                     style="width: {{ min($skorTWK, 100) }}%"></div>
                            </div>
                        </div>

                        <!-- TIU Progress Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">TIU (Tes Intelegensia Umum)</span>
                                <span class="text-sm font-medium {{ $skorTIU >= 80 ? 'text-green-600' : ($skorTIU >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $skorTIU }}%
                                </span>
                            </div>
                            <div class="h-4 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 {{ $skorTIU >= 80 ? 'bg-gradient-to-r from-green-500 to-emerald-600' : ($skorTIU >= 60 ? 'bg-gradient-to-r from-yellow-400 to-amber-500' : 'bg-gradient-to-r from-red-500 to-rose-600') }}"
                                     style="width: {{ min($skorTIU, 100) }}%"></div>
                            </div>
                        </div>

                        <!-- TKP Progress Bar -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-semibold text-gray-700">TKP (Tes Karakteristik Pribadi)</span>
                                <span class="text-sm font-medium {{ $skorTKP >= 80 ? 'text-green-600' : ($skorTKP >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $skorTKP }}%
                                </span>
                            </div>
                            <div class="h-4 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-500 {{ $skorTKP >= 80 ? 'bg-gradient-to-r from-green-500 to-emerald-600' : ($skorTKP >= 60 ? 'bg-gradient-to-r from-yellow-400 to-amber-500' : 'bg-gradient-to-r from-red-500 to-rose-600') }}"
                                     style="width: {{ min($skorTKP, 100) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Learning Suggestions -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-amber-500 mr-2"></i>
                            Saran Belajar
                        </h3>
                        @if($lowestCategory == 'TWK')
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-book text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-900 mb-2">Fokus pada TWK</h4>
                                        <p class="text-blue-800 text-sm">
                                            Performa TWK Anda masih perlu ditingkatkan. Fokuskan belajar Anda pada hafalan Sejarah Indonesia, Pilar Negara (Pancasila, UUD 1945, NKRI, Bhinneka Tunggal Ika), dan wawasan kebangsaan lainnya.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @elseif($lowestCategory == 'TIU')
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-6">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-brain text-amber-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-amber-900 mb-2">Fokus pada TIU</h4>
                                        <p class="text-amber-800 text-sm">
                                            Performa TIU Anda masih di bawah standar. Tingkatkan latihan soal penalaran logis, deret angka, silogisme, dan kemampuan verbal. Latihan secara rutin akan membantu meningkatkan kemampuan analisis Anda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @elseif($lowestCategory == 'TKP')
                            <div class="bg-cyan-50 border border-cyan-200 rounded-xl p-6">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-user-check text-cyan-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-cyan-900 mb-2">Fokus pada TKP</h4>
                                        <p class="text-cyan-800 text-sm">
                                            Performa TKP Anda perlu ditingkatkan. TKP mengukur karakteristik pribadi, jadi pastikan Anda memahami situasi kerja dan pilihan yang sesuai dengan nilai-nilai PNS. Latih kemampuan memahami konteks situasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                                <div class="flex items-start">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-trophy text-green-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-green-900 mb-2">Luar Biasa!</h4>
                                        <p class="text-green-800 text-sm">
                                            Anda belum memiliki data tes. Mulailah mengerjakan tes untuk melihat analisis performa Anda dan mendapatkan saran belajar yang personal.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Additional Features Section -->
        <div class="fade-in-delay-2 mt-12">
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Fitur Unggulan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Timer Real-time</h3>
                        <p class="text-sm text-gray-600">Pengatur waktu otomatis untuk setiap soal</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-chart-line text-green-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Analisis Hasil</h3>
                        <p class="text-sm text-gray-600">Laporan detail dan statistik performa</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-random text-purple-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Soal Acak</h3>
                        <p class="text-sm text-gray-600">Pertanyaan diacak untuk setiap sesi</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-mobile-alt text-amber-600"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Responsive</h3>
                        <p class="text-sm text-gray-600">Bisa diakses dari berbagai perangkat</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
