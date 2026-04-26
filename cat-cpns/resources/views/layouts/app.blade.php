<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CAT CPNS') | CAT CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeIn 0.6s ease-out; }
    </style>
</head>
<body class="bg-slate-50">
    <!-- Modern User Navigation -->
    <nav class="bg-white shadow-lg border-b border-slate-100 sticky top-0 z-50">
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
                    <a href="{{ route('test.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
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
                    <a href="{{ route('test.index') }}" class="text-slate-600 hover:text-slate-900 hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors duration-200">
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
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
