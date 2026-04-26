<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tes - CAT CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                    <a href="{{ route('riwayat.index') }}" class="text-blue-600 font-medium">
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
                    <a href="{{ route('riwayat.index') }}" class="text-blue-600 font-medium hover:bg-gray-50 px-3 py-2 rounded-lg transition-colors duration-200">
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
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Riwayat Tes</h1>
                    <p class="text-gray-600 mt-2">Lihat hasil dan statistik tes yang telah Anda kerjakan</p>
                </div>
                <a href="{{ route('dashboard') }}" 
                   class="px-4 py-2 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </div>

        <!-- Test History -->
        @if($testSessions->count() > 0)
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jumlah Soal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Skor
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Persentase
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($testSessions as $session)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $session->finished_at ? $session->finished_at->format('d M Y H:i') : '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($session->kategori == 'TWK') bg-blue-100 text-blue-800
                                            @elseif($session->kategori == 'TIU') bg-amber-100 text-amber-800
                                            @else bg-cyan-100 text-cyan-800 @endif">
                                            {{ $session->kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $session->total_questions }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium">{{ $session->score }}</span>
                                            <span class="text-gray-400">/</span>
                                            <span>{{ $session->total_questions * 5 }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            // Hitung Skor Maksimal dan Persentase
                                            $maxSkor = $session->total_questions * 5;
                                            $persentase = $maxSkor > 0 ? round(($session->score / $maxSkor) * 100) : 0;
                                            
                                            // Tentukan Kelulusan Berdasarkan Kategori (Rasio PG CPNS Asli)
                                            $isLulus = false;
                                            if ($session->kategori == 'TWK' && $persentase >= 43) {
                                                $isLulus = true;
                                            } elseif ($session->kategori == 'TIU' && $persentase >= 45) {
                                                $isLulus = true;
                                            } elseif ($session->kategori == 'TKP' && $persentase >= 73) {
                                                $isLulus = true;
                                            } elseif (($session->kategori == 'Semua' || $session->kategori == 'SKD') && $persentase >= 56) {
                                                // 56% adalah rata-rata ambang batas global dari total 550 poin
                                                $isLulus = true;
                                            }
                                        @endphp
                                        <span class="font-medium {{ $isLulus ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $persentase }}%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($isLulus)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Lulus
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Tidak Lulus
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('test.result', $session) }}" 
                                           class="text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                            <i class="fas fa-eye mr-1"></i>
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Statistics Summary -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clipboard-list text-blue-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Tes</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $testSessions->count() }}</p>
                            <p class="text-xs text-gray-400">
                                @php
                                    $passedCount = $testSessions->filter(function($s) {
                                        $maxSkor = $s->total_questions * 5;
                                        $persentase = $maxSkor > 0 ? ($s->score / $maxSkor) * 100 : 0;
                                        
                                        $isLulus = false;
                                        if ($s->kategori == 'TWK' && $persentase >= 43) {
                                            $isLulus = true;
                                        } elseif ($s->kategori == 'TIU' && $persentase >= 45) {
                                            $isLulus = true;
                                        } elseif ($s->kategori == 'TKP' && $persentase >= 73) {
                                            $isLulus = true;
                                        } elseif (($s->kategori == 'Semua' || $s->kategori == 'SKD') && $persentase >= 56) {
                                            $isLulus = true;
                                        }
                                        return $isLulus;
                                    })->count();
                                @endphp
                                {{ $passedCount }} lulus, {{ $testSessions->count() - $passedCount }} tidak lulus
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Rata-rata Skor</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $testSessions->count() > 0 ? number_format($testSessions->avg('score'), 1) : '0' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-percentage text-amber-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Rata-rata Persentase</p>
                            <p class="text-2xl font-bold text-gray-900">
                                @php
                                    $avgPercentage = $testSessions->count() > 0 
                                        ? $testSessions->avg(function($s) { 
                                            $maxSkor = $s->total_questions * 5;
                                            return $maxSkor > 0 ? ($s->score / $maxSkor) * 100 : 0; 
                                        }) 
                                        : 0;
                                    $passedCount = $testSessions->filter(function($s) {
                                        $maxSkor = $s->total_questions * 5;
                                        $persentase = $maxSkor > 0 ? ($s->score / $maxSkor) * 100 : 0;
                                        
                                        $isLulus = false;
                                        if ($s->kategori == 'TWK' && $persentase >= 43) {
                                            $isLulus = true;
                                        } elseif ($s->kategori == 'TIU' && $persentase >= 45) {
                                            $isLulus = true;
                                        } elseif ($s->kategori == 'TKP' && $persentase >= 73) {
                                            $isLulus = true;
                                        } elseif (($s->kategori == 'Semua' || $s->kategori == 'SKD') && $persentase >= 56) {
                                            $isLulus = true;
                                        }
                                        return $isLulus;
                                    })->count();
                                @endphp
                                <div class="flex items-center space-x-2">
                                    <span>{{ number_format($avgPercentage, 1) }}%</span>
                                    <span class="text-sm text-gray-500">({{ $passedCount }}/{{ $testSessions->count() }} lulus)</span>
                                </div>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-trophy text-purple-600"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Skor Tertinggi</p>
                            <p class="text-2xl font-bold text-gray-900">
                                {{ $testSessions->count() > 0 ? $testSessions->max('score') : '0' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-history text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Riwayat Tes</h3>
                <p class="text-gray-600 mb-6">Anda belum mengerjakan tes apa pun. Mulai tes CAT Anda sekarang!</p>
                <a href="{{ route('test.index') }}" 
                   class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 inline-flex items-center space-x-2">
                    <i class="fas fa-play"></i>
                    <span>Mulai Tes CAT</span>
                </a>
            </div>
        @endif
    </main>
</body>
</html>
