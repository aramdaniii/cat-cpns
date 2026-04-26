<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Saya - CAT CPNS</title>
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
        .fade-in-delay-1 {
            animation: fadeIn 0.6s ease-out 0.1s both;
        }
    </style>
</head>
<body class="bg-slate-50/50">
    <!-- Navigation -->
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
                    <a href="{{ route('certificates.index') }}" class="text-blue-600 font-medium hover:bg-slate-50 px-3 py-2 rounded-lg transition-colors duration-200">
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 overflow-x-hidden">
        <!-- Header -->
        <div class="fade-in mb-8">
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-2">
                Sertifikat Saya
            </h1>
            <p class="text-slate-600 text-sm">
                Kelola dan unduh sertifikat kelulusan tes CAT CPNS Anda
            </p>
        </div>

        <!-- Certificate List -->
        <div class="fade-in-delay-1">
            @forelse($certificates as $certificate)
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-4 sm:p-6 mb-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center space-x-3 sm:space-x-4 w-full sm:w-auto">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-certificate text-white text-xl sm:text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-semibold text-slate-900 truncate">{{ $certificate->title }}</h3>
                                <p class="text-slate-600 text-xs sm:text-sm mb-2 truncate">{{ $certificate->description }}</p>
                                <div class="flex flex-wrap gap-2 sm:gap-4 text-xs sm:text-sm text-slate-500">
                                    <span class="flex items-center"><i class="fas fa-tag mr-1 flex-shrink-0"></i> {{ $certificate->category }}</span>
                                    <span class="flex items-center"><i class="fas fa-calendar mr-1 flex-shrink-0"></i> {{ $certificate->issued_at->format('d M Y') }}</span>
                                    <span class="flex items-center"><i class="fas fa-chart-line mr-1 flex-shrink-0"></i> {{ $certificate->percentage }}%</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3 w-full sm:w-auto">
                            <div class="text-left sm:text-right w-full sm:w-auto">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $certificate->status_color }}-50 text-{{ $certificate->status_color }}-700">
                                    {{ $certificate->status_label }}
                                </span>
                                @if($certificate->expires_at && $certificate->expires_at->isFuture())
                                    <p class="text-xs text-slate-500 mt-1">
                                        Berlaku hingga {{ $certificate->expires_at->format('d M Y') }}
                                    </p>
                                @endif
                            </div>
                            
                            @if($certificate->isValid())
                                <a href="{{ route('certificates.show', $certificate) }}"
                                   class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200 text-center text-sm">
                                    <i class="fas fa-eye mr-2"></i>Lihat
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Verification Info -->
                    <div class="mt-4 pt-4 border-t border-slate-200">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 sm:gap-4">
                            <div class="text-xs sm:text-sm text-slate-600">
                                <span class="font-medium">No. Sertifikat:</span> {{ $certificate->certificate_number }}
                            </div>
                            <div class="text-xs sm:text-sm text-slate-600">
                                <span class="font-medium">Kode Verifikasi:</span> 
                                <code class="bg-slate-100 px-2 py-1 rounded text-xs">{{ $certificate->verification_code }}</code>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-8 sm:p-12 text-center">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-certificate text-slate-400 text-2xl sm:text-3xl"></i>
                    </div>
                    <h3 class="text-base sm:text-lg font-semibold text-slate-900 mb-2">Belum Ada Sertifikat</h3>
                    <p class="text-slate-600 text-sm sm:text-base mb-6">
                        Anda belum memiliki sertifikat. Selesaikan tes dengan nilai minimal 65% untuk mendapatkan sertifikat.
                    </p>
                    <a href="{{ route('test.index') }}" 
                       class="px-6 py-3 bg-blue-500 text-white font-medium rounded-xl hover:bg-blue-600 transition-colors duration-200 inline-flex items-center justify-center">
                        <i class="fas fa-play mr-2"></i>Mulai Tes
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($certificates->hasPages())
            <div class="fade-in-delay-1 mt-6">
                {{ $certificates->links() }}
            </div>
        @endif
    </main>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Download certificate as PDF
        async function downloadCertificate(event, certificateId, title) {
            event.preventDefault();
            event.stopPropagation();

            try {
                // Fetch certificate data
                const response = await fetch(`/certificates/${certificateId}/pdf-data`);
                const data = await response.json();

                // Create premium certificate HTML
                const certificateHTML = `
                    <div style="padding: 0; font-family: 'Times New Roman', serif; max-width: 1123px; margin: 0 auto; background: white;">
                        <!-- Decorative Border -->
                        <div style="border: 15px solid #1e3a8a; padding: 60px; text-align: center; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); position: relative;">
                            <!-- Inner decorative border -->
                            <div style="border: 3px solid #3b82f6; padding: 40px; position: relative;">
                                <!-- Corner decorations -->
                                <div style="position: absolute; top: 20px; left: 20px; width: 60px; height: 60px; border-top: 4px solid #fbbf24; border-left: 4px solid #fbbf24;"></div>
                                <div style="position: absolute; top: 20px; right: 20px; width: 60px; height: 60px; border-top: 4px solid #fbbf24; border-right: 4px solid #fbbf24;"></div>
                                <div style="position: absolute; bottom: 20px; left: 20px; width: 60px; height: 60px; border-bottom: 4px solid #fbbf24; border-left: 4px solid #fbbf24;"></div>
                                <div style="position: absolute; bottom: 20px; right: 20px; width: 60px; height: 60px; border-bottom: 4px solid #fbbf24; border-right: 4px solid #fbbf24;"></div>

                                <!-- Logo Section -->
                                <div style="margin-bottom: 40px;">
                                    <div style="display: inline-block; width: 120px; height: 120px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(30, 58, 138, 0.3);">
                                        <span style="font-size: 60px; color: white; font-weight: bold;">CP</span>
                                    </div>
                                </div>

                                <!-- Header -->
                                <div style="margin-bottom: 30px;">
                                    <h1 style="color: #1e3a8a; font-size: 48px; margin: 0; font-weight: bold; text-transform: uppercase; letter-spacing: 4px;">SERTIFIKAT</h1>
                                    <p style="color: #6b7280; font-size: 20px; margin-top: 10px; letter-spacing: 2px;">CAT CPNS - SISTEM ASESMEN KOMPETENSI</p>
                                </div>

                                <!-- Decorative Line -->
                                <div style="margin: 30px auto; width: 200px; height: 3px; background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);"></div>

                                <!-- Recipient Section -->
                                <div style="margin-bottom: 40px;">
                                    <p style="color: #6b7280; font-size: 18px; margin: 0; font-style: italic;">Diberikan kepada</p>
                                    <h2 style="color: #0f172a; font-size: 42px; margin: 15px 0; font-weight: bold; text-transform: uppercase; letter-spacing: 2px;">${data.user_name}</h2>
                                </div>

                                <!-- Achievement Section -->
                                <div style="margin-bottom: 40px;">
                                    <p style="color: #6b7280; font-size: 18px; margin: 0; font-style: italic;">Atas kelulusan dalam ujian</p>
                                    <h3 style="color: #1e3a8a; font-size: 32px; margin: 15px 0; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">${title}</h3>
                                </div>

                                <!-- Score Table -->
                                <div style="margin: 50px auto; max-width: 700px;">
                                    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                        <tr>
                                            <td style="border: 2px solid #e5e7eb; padding: 20px; text-align: center; background: #f8fafc;">
                                                <p style="color: #6b7280; font-size: 16px; margin: 0; font-weight: bold;">TWK</p>
                                                <p style="color: #1e3a8a; font-size: 36px; margin: 10px 0; font-weight: bold;">${data.twk_score}%</p>
                                            </td>
                                            <td style="border: 2px solid #e5e7eb; padding: 20px; text-align: center; background: #f8fafc;">
                                                <p style="color: #6b7280; font-size: 16px; margin: 0; font-weight: bold;">TIU</p>
                                                <p style="color: #1e3a8a; font-size: 36px; margin: 10px 0; font-weight: bold;">${data.tiu_score}%</p>
                                            </td>
                                            <td style="border: 2px solid #e5e7eb; padding: 20px; text-align: center; background: #f8fafc;">
                                                <p style="color: #6b7280; font-size: 16px; margin: 0; font-weight: bold;">TKP</p>
                                                <p style="color: #1e3a8a; font-size: 36px; margin: 10px 0; font-weight: bold;">${data.tkp_score}%</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Total Score Section -->
                                <div style="margin-bottom: 40px; padding: 30px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); border-radius: 10px;">
                                    <p style="color: white; font-size: 24px; margin: 0; font-weight: bold;">SKOR TOTAL</p>
                                    <p style="color: #fbbf24; font-size: 56px; margin: 10px 0; font-weight: bold;">${data.percentage}%</p>
                                    <p style="color: ${data.percentage >= 65 ? '#10b981' : '#ef4444'}; font-size: 28px; margin: 10px 0; font-weight: bold; text-transform: uppercase;">${data.percentage >= 65 ? 'LULUS' : 'TIDAK LULUS'}</p>
                                </div>

                                <!-- Certificate Details -->
                                <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #e5e7eb;">
                                    <table style="width: 100%; border-collapse: collapse;">
                                        <tr>
                                            <td style="padding: 15px; text-align: left;">
                                                <p style="color: #6b7280; font-size: 14px; margin: 0; font-weight: bold;">NOMOR SERTIFIKAT</p>
                                                <p style="color: #0f172a; font-size: 18px; margin: 5px 0; font-family: 'Courier New', monospace;">${data.certificate_number}</p>
                                            </td>
                                            <td style="padding: 15px; text-align: left;">
                                                <p style="color: #6b7280; font-size: 14px; margin: 0; font-weight: bold;">TANGGAL UJIAN</p>
                                                <p style="color: #0f172a; font-size: 18px; margin: 5px 0;">${data.exam_date}</p>
                                            </td>
                                            <td style="padding: 15px; text-align: left;">
                                                <p style="color: #6b7280; font-size: 14px; margin: 0; font-weight: bold;">KODE VERIFIKASI</p>
                                                <p style="color: #0f172a; font-size: 18px; margin: 5px 0; font-family: 'Courier New', monospace;">${data.verification_code}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Footer -->
                                <div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #e5e7eb;">
                                    <p style="color: #9ca3af; font-size: 14px; margin: 0; font-style: italic;">Sertifikat ini diterbitkan secara otomatis oleh sistem CAT CPNS</p>
                                    <p style="color: #9ca3af; font-size: 12px; margin: 5px 0;">Dokumen ini sah dan dapat diverifikasi secara online</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Create a temporary element
                const element = document.createElement('div');
                element.innerHTML = certificateHTML;
                document.body.appendChild(element);

                // Generate PDF with premium settings
                const opt = {
                    margin: 0,
                    filename: `Sertifikat_${title.replace(/\s+/g, '_')}_${data.certificate_number}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { 
                        scale: 3,
                        useCORS: true,
                        letterRendering: true
                    },
                    jsPDF: { 
                        unit: 'mm', 
                        format: 'a4', 
                        orientation: 'landscape' 
                    }
                };

                html2pdf().set(opt).from(element).save();

                // Remove temporary element
                document.body.removeChild(element);

            } catch (error) {
                console.error('Error downloading certificate:', error);
                alert('Gagal mengunduh sertifikat. Silakan coba lagi.');
            }
        }
    </script>
</body>
</html>
