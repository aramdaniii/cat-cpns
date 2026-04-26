<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulai Tes CAT - CAT CPNS</title>
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
<body class="bg-slate-50/50">
    <!-- Modern Navigation -->
    <nav class="bg-white shadow-lg border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-slate-900">CAT CPNS</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Dashboard
                    </a>
                    <a href="{{ route('test.index') }}" class="text-blue-600 font-medium">
                        Tes
                    </a>
                    <a href="{{ route('certificates.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Sertifikat
                    </a>
                    <a href="{{ route('riwayat.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Riwayat
                    </a>

                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-slate-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-slate-600 text-sm"></i>
                        </div>
                        <span class="text-slate-700 font-medium">{{ auth()->user()->name }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-500 hover:text-slate-700 transition-colors duration-200">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-slate-600 hover:text-slate-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-slate-900 hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('test.index') }}" class="text-blue-600 font-medium hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-clipboard-list mr-2"></i> Tes
                    </a>
                    <a href="{{ route('certificates.index') }}" class="text-slate-600 hover:text-slate-900 hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-certificate mr-2"></i> Sertifikat
                    </a>
                    <a href="{{ route('riwayat.index') }}" class="text-slate-600 hover:text-slate-900 hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors duration-200">
                        <i class="fas fa-history mr-2"></i> Riwayat
                    </a>

                    <div class="border-t border-slate-200 pt-3 mt-3">
                        <div class="flex items-center space-x-2 px-3 py-2">
                            <div class="w-8 h-8 bg-slate-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-slate-600 text-sm"></i>
                            </div>
                            <span class="text-slate-700 font-medium">{{ auth()->user()->name }}</span>
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
        <!-- Modern Card Container -->
        <div class="fade-in">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-8 max-w-3xl mx-auto">
                
                <!-- Page Title -->
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-6">
                    Mulai Tes CAT CPNS
                </h1>

                <!-- Flash Messages -->
                @if (session('error'))
                    <div class="mb-6 fade-in-delay-1">
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                            <p class="text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif
                
                @if (session('info'))
                    <div class="mb-6 fade-in-delay-1">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                            <p class="text-blue-800">{{ session('info') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('test.start') }}" class="space-y-6 fade-in-delay-1">
                    @csrf
                    
                    <!-- Form Inputs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kategori Dropdown -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-slate-700 mb-2">
                                Pilih Kategori Tes
                            </label>
                            <select id="kategori" 
                                    name="kategori" 
                                    required
                                    class="w-full px-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white text-sm @error('kategori') border-red-300 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoriOptions as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Soal Input -->
                        <div>
                            <label for="jumlah_soal" class="block text-sm font-medium text-slate-700 mb-2">
                                Jumlah Soal
                            </label>
                            <input type="number" 
                                   id="jumlah_soal" 
                                   name="jumlah_soal" 
                                   min="15" 
                                   max="150" 
                                   value="30" 
                                   required
                                   class="w-full px-3 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white text-sm @error('jumlah_soal') border-red-300 @enderror">
                            @error('jumlah_soal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-slate-500">
                                Standar SKD: 110 soal (100 menit). Minimal 15 soal, maksimal 150 soal.
                            </p>
                        </div>
                    </div>

                    <!-- Modern Alert Box -->
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-5 fade-in-delay-2">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle text-slate-400 text-lg mt-0.5"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-slate-900 mb-3">
                                    Informasi Tes
                                </h3>
                                <ul class="space-y-2 text-sm text-slate-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Tes akan berlangsung sesuai dengan jumlah soal yang Anda pilih</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Setiap soal hanya memiliki satu jawaban benar</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Anda dapat kembali ke soal sebelumnya untuk mengubah jawaban</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                        <span>Hasil tes akan ditampilkan setelah selesai menjawab semua soal</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between pt-4 fade-in-delay-2">
                        <a href="{{ route('dashboard') }}" 
                           class="text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl px-5 py-2.5 font-medium transition-colors flex items-center justify-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-6 py-2.5 font-medium shadow-sm hover:-translate-y-0.5 transition-all flex items-center justify-center space-x-2">
                            <i class="fas fa-play"></i>
                            <span>Mulai Tes</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
