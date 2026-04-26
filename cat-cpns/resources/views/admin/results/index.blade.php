@extends('layouts.admin')

@section('title', 'Monitoring Hasil')

@section('content')
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
        <!-- Header Section -->
        <div class="fade-in mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 sm:mb-0">
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-2">
                        Monitoring Hasil Ujian
                    </h1>
                    <p class="text-slate-600 text-sm">
                        Pantau hasil ujian semua peserta CAT CPNS
                    </p>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="fade-in-delay-1">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 overflow-hidden">
                <!-- Filter Section -->
                <div class="bg-slate-50/80 px-6 py-4 border-b border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <form method="GET" action="{{ route('admin.monitoring-hasil') }}" class="flex-1">
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1 sm:flex-initial">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-filter text-slate-400 text-sm"></i>
                                        </div>
                                        <select name="kategori" onchange="this.form.submit()"
                                                class="w-full sm:w-auto pl-10 pr-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                            <option value="">Semua Kategori</option>
                                            <option value="Semua" {{ request('kategori') == 'Semua' ? 'selected' : '' }}>Simulasi Full (SKD)</option>
                                            <option value="TWK" {{ request('kategori') == 'TWK' ? 'selected' : '' }}>Tes Wawasan Kebangsaan (TWK)</option>
                                            <option value="TIU" {{ request('kategori') == 'TIU' ? 'selected' : '' }}>Tes Intelegensia Umum (TIU)</option>
                                            <option value="TKP" {{ request('kategori') == 'TKP' ? 'selected' : '' }}>Tes Karakteristik Pribadi (TKP)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex-1 sm:flex-initial">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-slate-400 text-sm"></i>
                                        </div>
                                        <input type="text" 
                                               name="search" 
                                               value="{{ request('search') }}"
                                               placeholder="Cari nama atau email..."
                                               class="w-full sm:w-64 pl-10 pr-3 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white text-sm">
                                    </div>
                                </div>
                                <button type="submit" 
                                        class="px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200 text-sm">
                                    <i class="fas fa-search mr-2"></i>
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Nama Peserta
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Kategori
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Skor
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Persentase
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Waktu Selesai
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse($testSessions as $index => $session)
                                <tr class="hover:bg-slate-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ ($testSessions->currentPage() - 1) * $testSessions->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center">
                                                    <span class="text-white font-medium text-sm">
                                                        {{ strtoupper(substr($session->user->name, 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-slate-900">
                                                    {{ $session->user->name }}
                                                </div>
                                                <div class="text-sm text-slate-500">
                                                    {{ $session->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($session->kategori == 'Semua' || $session->kategori == 'SKD')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                                <i class="fas fa-clipboard-check mr-1"></i>
                                                SKD Full
                                            </span>
                                        @elseif($session->kategori == 'TWK')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                <i class="fas fa-book mr-1"></i>
                                                TWK
                                            </span>
                                        @elseif($session->kategori == 'TIU')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700">
                                                <i class="fas fa-brain mr-1"></i>
                                                TIU
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-50 text-cyan-700">
                                                <i class="fas fa-user-check mr-1"></i>
                                                TKP
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $session->score }} / {{ $session->total_questions * 5 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $maxSkor = $session->total_questions * 5;
                                            $percentage = $maxSkor > 0 ? round(($session->score / $maxSkor) * 100, 1) : 0;
                                        @endphp
                                        @if($percentage >= 65)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ $percentage }}%
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                {{ $percentage }}%
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        {{ $session->finished_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.monitoring-hasil.show', $session) }}" 
                                               class="text-slate-400 hover:text-blue-500 transition-colors duration-200"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-clipboard-check text-slate-400 text-2xl"></i>
                                            </div>
                                            <p class="text-slate-600 font-medium">Belum ada hasil ujian</p>
                                            <p class="text-slate-500 text-sm mt-1">Hasil ujian akan muncul di sini setelah peserta menyelesaikan tes</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($testSessions->hasPages())
                    <div class="bg-slate-50 px-6 py-3 border-t border-slate-200 flex items-center justify-between">
                        <div class="text-sm text-slate-700">
                            Menampilkan <span class="font-medium">{{ $testSessions->firstItem() }}</span> hingga 
                            <span class="font-medium">{{ $testSessions->lastItem() }}</span> dari 
                            <span class="font-medium">{{ $testSessions->total() }}</span> hasil
                        </div>
                        <div>
                            {{ $testSessions->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection
