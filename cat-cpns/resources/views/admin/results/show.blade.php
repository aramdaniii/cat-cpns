@extends('layouts.admin')

@section('title', 'Detail Hasil')

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
        <div class="fade-in mb-6">
            <div class="flex items-center space-x-4 mb-4">
                <a href="{{ route('admin.monitoring-hasil') }}" class="text-slate-600 hover:text-slate-900 transition-colors duration-200">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Detail Hasil Ujian
                </h1>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="fade-in-delay-1 mb-6">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-xl">
                                {{ strtoupper(substr($session->user->name, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">{{ $session->user->name }}</h2>
                            <p class="text-slate-600">{{ $session->user->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center space-x-2 mb-2">
                            @if($session->kategori == 'TWK')
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
                            @if($passed)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    LULUS
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    TIDAK LULUS
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-600">
                            {{ $session->finished_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Score Summary -->
        <div class="fade-in-delay-1 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                    <div class="text-center">
                        <p class="text-sm font-medium text-slate-600 mb-2">Skor Akhir</p>
                        <p class="text-3xl font-bold text-slate-900">{{ $correctCount }} / {{ $session->total_questions * 5 }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(34,197,94,0.1)] border border-slate-100 p-6">
                    <div class="text-center">
                        <p class="text-sm font-medium text-slate-600 mb-2">Persentase</p>
                        <p class="text-3xl font-bold {{ $passed ? 'text-emerald-600' : 'text-red-600' }}">{{ $percentage }}%</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(251,146,60,0.1)] border border-slate-100 p-6">
                    <div class="text-center">
                        <p class="text-sm font-medium text-slate-600 mb-2">Benar</p>
                        <p class="text-3xl font-bold text-emerald-600">{{ $correctCount }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(239,68,68,0.1)] border border-slate-100 p-6">
                    <div class="text-center">
                        <p class="text-sm font-medium text-slate-600 mb-2">Salah</p>
                        <p class="text-3xl font-bold text-red-600">{{ $session->total_questions - $correctCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions Detail -->
        <div class="fade-in-delay-2">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 overflow-hidden">
                <div class="bg-slate-50/80 px-6 py-4 border-b border-slate-200">
                    <h2 class="text-xl font-bold text-slate-900">Detail Jawaban</h2>
                </div>
                
                <div class="divide-y divide-slate-200">
                    @foreach($results as $index => $result)
                        <div class="p-6 {{ $result['is_correct'] ? 'bg-emerald-50/30' : 'bg-red-50/30' }}">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <span class="flex-shrink-0 w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-sm font-medium text-slate-700">
                                        {{ $index + 1 }}
                                    </span>
                                    @if($result['is_correct'])
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            <i class="fas fa-check mr-1"></i>
                                            Benar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times mr-1"></i>
                                            Salah
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-slate-900 font-medium">{{ $result['question']->pertanyaan }}</p>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                                <div class="{{ $result['question']->jawaban_benar === 'A' ? 'border-2 border-emerald-500 bg-emerald-50' : 'border border-slate-200 bg-white' }} rounded-lg p-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium text-slate-700">A.</span>
                                        <span class="text-slate-600">{{ $result['question']->pilihan_a }}</span>
                                        @if($result['question']->jawaban_benar === 'A')
                                            <i class="fas fa-check text-emerald-600 ml-auto"></i>
                                        @endif
                                    </div>
                                    @if($result['user_answer'] === 'A')
                                        <div class="mt-2 text-xs {{ $result['is_correct'] ? 'text-emerald-600' : 'text-red-600' }}">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            Jawaban Anda
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="{{ $result['question']->jawaban_benar === 'B' ? 'border-2 border-emerald-500 bg-emerald-50' : 'border border-slate-200 bg-white' }} rounded-lg p-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium text-slate-700">B.</span>
                                        <span class="text-slate-600">{{ $result['question']->pilihan_b }}</span>
                                        @if($result['question']->jawaban_benar === 'B')
                                            <i class="fas fa-check text-emerald-600 ml-auto"></i>
                                        @endif
                                    </div>
                                    @if($result['user_answer'] === 'B')
                                        <div class="mt-2 text-xs {{ $result['is_correct'] ? 'text-emerald-600' : 'text-red-600' }}">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            Jawaban Anda
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="{{ $result['question']->jawaban_benar === 'C' ? 'border-2 border-emerald-500 bg-emerald-50' : 'border border-slate-200 bg-white' }} rounded-lg p-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium text-slate-700">C.</span>
                                        <span class="text-slate-600">{{ $result['question']->pilihan_c }}</span>
                                        @if($result['question']->jawaban_benar === 'C')
                                            <i class="fas fa-check text-emerald-600 ml-auto"></i>
                                        @endif
                                    </div>
                                    @if($result['user_answer'] === 'C')
                                        <div class="mt-2 text-xs {{ $result['is_correct'] ? 'text-emerald-600' : 'text-red-600' }}">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            Jawaban Anda
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="{{ $result['question']->jawaban_benar === 'D' ? 'border-2 border-emerald-500 bg-emerald-50' : 'border border-slate-200 bg-white' }} rounded-lg p-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium text-slate-700">D.</span>
                                        <span class="text-slate-600">{{ $result['question']->pilihan_d }}</span>
                                        @if($result['question']->jawaban_benar === 'D')
                                            <i class="fas fa-check text-emerald-600 ml-auto"></i>
                                        @endif
                                    </div>
                                    @if($result['user_answer'] === 'D')
                                        <div class="mt-2 text-xs {{ $result['is_correct'] ? 'text-emerald-600' : 'text-red-600' }}">
                                            <i class="fas fa-user-circle mr-1"></i>
                                            Jawaban Anda
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            @if($result['question']->pembahasan)
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <p class="text-sm font-medium text-blue-900 mb-1">Pembahasan:</p>
                                    <p class="text-sm text-blue-800">{{ $result['question']->pembahasan }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
