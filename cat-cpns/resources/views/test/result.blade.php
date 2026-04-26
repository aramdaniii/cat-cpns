<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes - CAT CPNS</title>
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
    <nav class="bg-white shadow-lg border-b border-slate-200">
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
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Dashboard
                    </a>
                    <a href="{{ route('test.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Tes
                    </a>
                    <a href="{{ route('certificates.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Sertifikat
                    </a>
                    <a href="{{ route('riwayat.index') }}" class="text-blue-600 font-medium">
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
            </div>
        </div>
    </nav>

    <!-- Calculate score from results to ensure consistency -->
        @php
            $correctCount = 0;
            foreach($results as $result) {
                if($result['is_correct']) {
                    $correctCount++;
                }
            }
            $wrongCount = $session->total_questions - $correctCount;
            $scorePercentage = round(($correctCount / $session->total_questions) * 100);
        @endphp

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Score Summary -->
        <div class="fade-in mb-8">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-8">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold text-slate-800 tracking-tight mb-2">
                        @if($scorePercentage >= 65)
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-700">
                                Selamat! Anda Lulus
                            </span>
                        @else
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-amber-700">
                                Tes Selesai
                            </span>
                        @endif
                    </h1>
                    <p class="text-slate-600">Hasil tes {{ $session->kategori }} Anda</p>
                </div>

                <!-- Score Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <!-- Benar Card -->
                    <div class="fade-in-delay-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-check-circle text-emerald-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-slate-500">Benar</p>
                                    <p class="text-2xl font-bold text-emerald-600">{{ $correctCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Salah Card -->
                    <div class="fade-in-delay-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-slate-500">Salah</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $wrongCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skor Card -->
                    <div class="fade-in-delay-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-percentage text-blue-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-slate-500">Skor</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $scorePercentage }}%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kategori Card -->
                    <div class="fade-in-delay-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-tag text-purple-600 text-xl"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-slate-500">Kategori</p>
                                    <p class="text-2xl font-bold text-purple-600">{{ $session->kategori }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificate Info -->
                @if($scorePercentage >= 65 && $certificate)
                    <div class="fade-in-delay-2 bg-emerald-50 border border-emerald-200 rounded-xl p-6 mb-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-certificate text-emerald-600 text-2xl mr-4"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-emerald-800 mb-2">
                                    Sertifikat Telah Diterbitkan!
                                </h3>
                                <p class="text-emerald-700 mb-4">
                                    Sertifikat {{ $certificate->category }} Anda telah siap. Unduh sertifikat Anda sekarang.
                                </p>
                                <div class="flex space-x-4">
                                    <a href="{{ route('certificates.show', $certificate) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transition-colors">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat Sertifikat
                                    </a>
                                    <a href="{{ route('certificates.download', $certificate) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-download mr-2"></i>
                                        Unduh PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Test Details -->
        <div class="fade-in-delay-2">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-8">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-800 tracking-tight mb-2">
                        Detail Jawaban
                    </h2>
                    <p class="text-slate-600">Rincian jawaban Anda untuk setiap soal</p>
                </div>

                <!-- Modern Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Pertanyaan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Jawaban Anda
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Jawaban Benar
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                    Pembahasan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($results as $index => $result)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        <span class="line-clamp-3">{{ $result['question']->pertanyaan }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($result['user_answer'])
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                                {{ $result['user_answer'] }}
                                            </span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                            {{ $result['correct_answer'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($result['is_correct'])
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                                <i class="fas fa-check mr-1.5"></i>
                                                Benar
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                                <i class="fas fa-times mr-1.5"></i>
                                                Salah
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-700">
                                        @if($result['question']->pembahasan)
                                            <button type="button" 
                                                    onclick="togglePembahasan({{ $index }})" 
                                                    class="inline-flex items-center px-3 py-1.5 text-blue-600 hover:text-blue-800 hover:underline font-medium text-sm transition-all duration-200 cursor-pointer">
                                                <i class="fas fa-book-open mr-1.5"></i>
                                                Lihat Pembahasan
                                            </button>
                                            <div id="pembahasan-{{ $index }}" class="hidden mt-3 p-4 bg-blue-50/80 border border-blue-200 rounded-lg text-sm text-slate-700 transition-all duration-200">
                                                <div class="flex items-start mb-2">
                                                    <i class="fas fa-info-circle text-blue-500 mr-2 mt-0.5"></i>
                                                    <h4 class="font-semibold text-blue-800">Pembahasan</h4>
                                                </div>
                                                <div class="text-slate-600 leading-relaxed">
                                                    {{ $result['question']->pembahasan }}
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-slate-400 italic">Tidak ada pembahasan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('test.index') }}" class="btn btn-primary">
                        <i class="fas fa-redo"></i> Tes Lagi
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePembahasan(index) {
            const pembahasanRow = document.getElementById('pembahasan-' + index);
            if (pembahasanRow) {
                pembahasanRow.classList.toggle('hidden');
                
                // Update button text based on visibility
                const button = pembahasanRow.previousElementSibling;
                if (button && button.tagName === 'BUTTON') {
                    const buttonText = pembahasanRow.classList.contains('hidden') ? 'Lihat Pembahasan' : 'Tutup Pembahasan';
                    button.innerHTML = buttonText.includes('Lihat') ? 
                        '<i class="fas fa-book-open mr-1.5"></i>' + buttonText :
                        '<i class="fas fa-times mr-1.5"></i>' + buttonText;
                }
            }
        }
        
        // Auto-scroll to first incorrect answer
        window.addEventListener('load', function() {
            const firstIncorrect = document.querySelector('.bg-red-50');
            if (firstIncorrect) {
                firstIncorrect.closest('tr').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    </script>
</body>
</html>
