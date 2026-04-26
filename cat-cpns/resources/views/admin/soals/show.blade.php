@extends('layouts.admin')

@section('title', 'Detail Soal')

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
    .fade-in-delay-2 {
        animation: fadeIn 0.6s ease-out 0.2s both;
    }
</style>
        <!-- Header Section -->
        <div class="fade-in mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.soals.index') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                        Detail Soal #{{ $soal->id }}
                    </h1>
                </div>
                @if($soal->kategori == 'TWK')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                        <i class="fas fa-book mr-1"></i>
                        TWK
                    </span>
                @elseif($soal->kategori == 'TIU')
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
            </div>
        </div>

            <!-- Question Card -->
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-question-circle text-blue-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-900">Pertanyaan</h2>
                </div>
                <p class="text-slate-700 leading-relaxed">{{ $soal->pertanyaan }}</p>
            </div>

            <!-- Answer Options Card -->
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-list-check text-emerald-600"></i>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-900">Pilihan Jawaban</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                        @if($option === 'E' && empty($soal->opsi_e))
                            @continue
                        @endif
                        <div class="{{ $soal->jawaban_benar == $option ? 'border-2 border-emerald-500 bg-emerald-50/30' : 'border border-slate-200 bg-white' }} rounded-xl p-4 transition-all duration-200">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-8 h-8 {{ $soal->jawaban_benar == $option ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-600' }} rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ $option }}
                                </div>
                                <div class="flex-1">
                                    <p class="text-slate-700">{{ $soal->{'opsi_' . strtolower($option)} }}</p>
                                </div>
                                @if($soal->jawaban_benar == $option)
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-emerald-600 text-lg"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($soal->pembahasan)
                <!-- Discussion Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-lightbulb text-amber-600"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-slate-900">Pembahasan</h2>
                    </div>
                    <div class="bg-amber-50/50 rounded-lg p-4">
                        <p class="text-slate-700 leading-relaxed">{{ $soal->pembahasan }}</p>
                    </div>
                </div>
            @endif

            <!-- Info and Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Information Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-slate-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info-circle text-slate-600"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-slate-900">Informasi Soal</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-sm font-medium text-slate-600">ID Soal</span>
                            <span class="text-sm text-slate-900 font-mono">#{{ $soal->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-sm font-medium text-slate-600">Kategori</span>
                            @if($soal->kategori == 'TWK')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    TWK
                                </span>
                            @elseif($soal->kategori == 'TIU')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700">
                                    TIU
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-cyan-50 text-cyan-700">
                                    TKP
                                </span>
                            @endif
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-sm font-medium text-slate-600">Jawaban Benar</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                {{ $soal->jawaban_benar }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-sm font-medium text-slate-600">Dibuat</span>
                            <span class="text-sm text-slate-900">{{ $soal->created_at ? $soal->created_at->format('d M Y, H:i') : '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm font-medium text-slate-600">Diupdate</span>
                            <span class="text-sm text-slate-900">{{ $soal->updated_at ? $soal->updated_at->format('d M Y, H:i') : '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-red-50 rounded-lg flex items-center justify-center">
                            <i class="fas fa-cogs text-red-600"></i>
                        </div>
                        <h2 class="text-lg font-semibold text-slate-900">Aksi</h2>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.soals.edit', $soal) }}" 
                           class="w-full px-4 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-medium rounded-xl hover:from-amber-600 hover:to-amber-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg flex items-center justify-center space-x-2">
                            <i class="fas fa-edit"></i>
                            <span>Edit Soal</span>
                        </a>
                        
                        <form method="POST" action="{{ route('admin.soals.destroy', $soal) }}" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-xl hover:from-red-600 hover:to-red-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg flex items-center justify-center space-x-2">
                                <i class="fas fa-trash"></i>
                                <span>Hapus Soal</span>
                            </button>
                        </form>
                        
                        <a href="{{ route('admin.soals.index') }}" 
                           class="w-full px-4 py-3 bg-white border border-slate-300 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Daftar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endsection
