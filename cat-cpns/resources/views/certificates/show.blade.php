<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sertifikat - CAT CPNS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        .certificate-border {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 4px;
            border-radius: 16px;
        }
        .certificate-content {
            background: white;
            border-radius: 12px;
            padding: 2rem;
        }
    </style>
</head>
<body class="bg-slate-50/50">
    <!-- Navigation -->
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
                    <a href="{{ route('certificates.index') }}" class="text-blue-600 font-medium">
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
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="fade-in mb-8">
            <div class="flex items-center space-x-4 mb-6">
                <a href="{{ route('certificates.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Detail Sertifikat
                </h1>
            </div>
        </div>

        <!-- Certificate Display -->
        <div class="fade-in-delay-1">
            <div class="certificate-border max-w-4xl mx-auto">
                <div class="certificate-content">
                    <!-- Certificate Header -->
                    <div class="text-center mb-8">
                        <div class="w-24 h-24 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-award text-white text-4xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 mb-2">Sertifikat Kelulusan</h2>
                        <p class="text-slate-600">CAT CPNS - {{ $certificate->category }}</p>
                    </div>

                    <!-- Certificate Body -->
                    <div class="space-y-6 mb-8">
                        <div class="text-center">
                            <p class="text-lg text-slate-700 mb-4">
                                Dengan ini menyatakan bahwa
                            </p>
                            <div class="bg-slate-50 rounded-lg p-4 inline-block">
                                <h3 class="text-2xl font-bold text-slate-900">{{ $certificate->user->name }}</h3>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-lg text-slate-700 mb-4">
                                Telah berhasil lulus tes {{ $certificate->category }} dengan hasil:
                            </p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
                                @php
                                    $persentase = $certificate->total_questions > 0 ? round(($certificate->score / ($certificate->total_questions * 5)) * 100, 2) : 0;
                                @endphp
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <p class="text-3xl font-bold text-blue-600">{{ $certificate->score }}</p>
                                    <p class="text-sm text-slate-600">Skor Akhir</p>
                                </div>
                                <div class="bg-emerald-50 rounded-lg p-4">
                                    <p class="text-3xl font-bold text-emerald-600">{{ $persentase }}%</p>
                                    <p class="text-sm text-slate-600">Persentase</p>
                                </div>
                                <div class="bg-amber-50 rounded-lg p-4">
                                    <p class="text-3xl font-bold text-amber-600">{{ $certificate->total_questions }}</p>
                                    <p class="text-sm text-slate-600">Total Soal</p>
                                </div>
                                <div class="bg-purple-50 rounded-lg p-4">
                                    <p class="text-3xl font-bold text-purple-600">{{ $certificate->total_questions * 5 }}</p>
                                    <p class="text-sm text-slate-600">Skor Maksimal</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <p class="text-slate-600 italic">
                                "{{ $certificate->description }}"
                            </p>
                        </div>
                    </div>

                    <!-- Certificate Footer -->
                    <div class="border-t border-slate-200 pt-6">
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <p class="text-sm text-slate-600 mb-1">No. Sertifikat</p>
                                <p class="font-mono text-sm font-bold text-slate-900">{{ $certificate->certificate_number }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 mb-1">Tanggal Diterbitkan</p>
                                <p class="font-bold text-slate-900">{{ $certificate->issued_at->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600 mb-1">Kode Verifikasi</p>
                                <p class="font-mono text-sm font-bold text-slate-900">{{ $certificate->verification_code }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Verification Badge -->
                    <div class="text-center mt-6">
                        @if($certificate->isValid())
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                <i class="fas fa-check-circle mr-1"></i>
                                Sertifikat Valid
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                <i class="fas fa-times-circle mr-1"></i>
                                {{ $certificate->status_label }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="fade-in-delay-2 mt-8 text-center">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @if($certificate->isValid())
                    <a href="{{ route('certificates.download', $certificate) }}"
                       class="px-6 py-3 bg-emerald-500 text-white font-medium rounded-xl hover:bg-emerald-600 transition-colors duration-200 flex items-center justify-center space-x-2">
                        <i class="fas fa-download"></i>
                        <span>Unduh PDF</span>
                    </a>
                @endif
                
                <a href="{{ route('certificates.verify', $certificate->verification_code) }}" 
                   target="_blank"
                   class="px-6 py-3 bg-blue-500 text-white font-medium rounded-xl hover:bg-blue-600 transition-colors duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-external-link-alt"></i>
                    <span>Verifikasi Online</span>
                </a>
                
                <a href="{{ route('certificates.index') }}"
                   class="px-6 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </main>

</body>
</html>
