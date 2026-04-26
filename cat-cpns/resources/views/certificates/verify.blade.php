<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat - CAT CPNS</title>
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
                    <a href="/" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-slate-900">CAT CPNS</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="/" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Beranda
                    </a>
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="fade-in mb-8 text-center">
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight mb-2">
                Verifikasi Sertifikat
            </h1>
            <p class="text-slate-600 text-sm">
                Masukkan kode verifikasi untuk memvalidasi keaslian sertifikat
            </p>
        </div>

        <!-- Verification Form -->
        @if($error)
            <div class="fade-in mb-6">
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                        <p class="text-red-800">{{ $error }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(!$certificate)
            <div class="fade-in-delay-1 max-w-md mx-auto">
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                    <form method="GET" action="{{ route('certificates.verify', '__CODE__') }}" class="space-y-4">
                        <div>
                            <label for="verification_code" class="block text-sm font-medium text-slate-700 mb-2">
                                Kode Verifikasi
                            </label>
                            <input type="text" 
                                   id="verification_code" 
                                   name="code" 
                                   placeholder="Masukkan kode verifikasi 12 digit"
                                   maxlength="12"
                                   class="w-full px-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm font-mono uppercase"
                                   required>
                            <p class="mt-1 text-xs text-slate-500">
                                Kode verifikasi terdapat pada sertifikat yang diterbitkan
                            </p>
                        </div>
                        
                        <button type="submit" 
                                class="w-full px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg">
                            <i class="fas fa-search mr-2"></i>
                            Verifikasi Sertifikat
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Certificate Found -->
            <div class="fade-in-delay-1">
                <div class="certificate-border max-w-4xl mx-auto">
                    <div class="certificate-content">
                        <!-- Verification Status -->
                        <div class="text-center mb-6">
                            @if($certificate->isValid())
                                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-emerald-50 text-emerald-700 mb-4">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Sertifikat Valid
                                </div>
                            @else
                                <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-red-50 text-red-700 mb-4">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    {{ $certificate->status_label }}
                                </div>
                            @endif
                        </div>

                        <!-- Certificate Header -->
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-award text-white text-3xl"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-2">{{ $certificate->title }}</h2>
                            <p class="text-slate-600">CAT CPNS - {{ $certificate->category }}</p>
                        </div>

                        <!-- Certificate Details -->
                        <div class="space-y-4 mb-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-50 rounded-lg p-3">
                                    <p class="text-sm text-slate-600 mb-1">Nama Peserta</p>
                                    <p class="font-bold text-slate-900">{{ $certificate->user->name }}</p>
                                </div>
                                <div class="bg-slate-50 rounded-lg p-3">
                                    <p class="text-sm text-slate-600 mb-1">No. Sertifikat</p>
                                    <p class="font-mono text-sm font-bold text-slate-900">{{ $certificate->certificate_number }}</p>
                                </div>
                                <div class="bg-slate-50 rounded-lg p-3">
                                    <p class="text-sm text-slate-600 mb-1">Tanggal Diterbitkan</p>
                                    <p class="font-bold text-slate-900">{{ $certificate->issued_at->format('d F Y') }}</p>
                                </div>
                                <div class="bg-slate-50 rounded-lg p-3">
                                    <p class="text-sm text-slate-600 mb-1">Status</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $certificate->status_color }}-50 text-{{ $certificate->status_color }}-700">
                                        {{ $certificate->status_label }}
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-blue-50 rounded-lg p-3 text-center">
                                    <p class="text-2xl font-bold text-blue-600">{{ $certificate->score }}</p>
                                    <p class="text-xs text-slate-600">Benar</p>
                                </div>
                                <div class="bg-emerald-50 rounded-lg p-3 text-center">
                                    <p class="text-2xl font-bold text-emerald-600">{{ $certificate->percentage }}%</p>
                                    <p class="text-xs text-slate-600">Persentase</p>
                                </div>
                                <div class="bg-amber-50 rounded-lg p-3 text-center">
                                    <p class="text-2xl font-bold text-amber-600">{{ $certificate->total_questions }}</p>
                                    <p class="text-xs text-slate-600">Total Soal</p>
                                </div>
                            </div>

                            @if($certificate->expires_at)
                                <div class="bg-purple-50 rounded-lg p-3">
                                    <p class="text-sm text-slate-600 mb-1">Masa Berlaku</p>
                                    <p class="font-bold text-slate-900">
                                        @if($certificate->expires_at->isFuture())
                                            Hingga {{ $certificate->expires_at->format('d F Y') }}
                                        @else
                                            Kadaluarsa pada {{ $certificate->expires_at->format('d F Y') }}
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Verification Info -->
                        <div class="border-t border-slate-200 pt-4">
                            <div class="text-center">
                                <p class="text-sm text-slate-600 mb-2">
                                    <i class="fas fa-shield-alt mr-1"></i>
                                    Sertifikat ini diverifikasi secara digital dan valid
                                </p>
                                <p class="text-xs text-slate-500">
                                    Kode verifikasi: <code class="bg-slate-100 px-2 py-1 rounded">{{ $certificate->verification_code }}</code>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-6">
                    <a href="{{ request->url() }}" 
                       class="px-6 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200">
                        <i class="fas fa-redo mr-2"></i>
                        Verifikasi Sertifikat Lain
                    </a>
                </div>
            </div>
        @endif
    </main>

    <script>
        // Auto-focus on verification code input
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('verification_code');
            if (input) {
                input.focus();
                
                // Format input to uppercase
                input.addEventListener('input', function(e) {
                    e.target.value = e.target.value.toUpperCase();
                });
            }
        });
    </script>
</body>
</html>
