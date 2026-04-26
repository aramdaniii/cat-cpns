@extends('layouts.admin')

@section('title', 'Dashboard Admin')

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
    .fade-in-delay-3 {
        animation: fadeIn 0.6s ease-out 0.3s both;
    }
</style>
        <!-- Header Section -->
        <div class="fade-in mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-6 lg:mb-0">
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-2">
                        Dashboard Admin
                    </h1>
                    <p class="text-slate-600 text-sm">
                        Ringkasan data dan manajemen sistem CAT
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.soals.create') }}" 
                       class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-xl hover:from-emerald-600 hover:to-emerald-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Soal</span>
                    </a>
                    <a href="{{ route('admin.soals.upload') }}" 
                       class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium rounded-xl hover:from-blue-600 hover:to-indigo-700 transform hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-file-excel"></i>
                        <span>Upload Soal (Excel/CSV)</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Premium Statistic Cards -->
        <div class="fade-in-delay-1 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Soal Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-full -mr-10 -mt-10"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 mb-1">Total Soal</p>
                                <p class="text-4xl font-extrabold text-slate-900">{{ App\Models\Soal::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-emerald-600 font-medium">+12%</span>
                            <span class="text-slate-500 ml-2">dari bulan lalu</span>
                        </div>
                    </div>
                </div>

                <!-- Total User Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(34,197,94,0.1)] border border-slate-100 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-emerald-50 rounded-full -mr-10 -mt-10"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 mb-1">Total User</p>
                                <p class="text-4xl font-extrabold text-slate-900">{{ App\Models\User::count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-emerald-600 font-medium">+8%</span>
                            <span class="text-slate-500 ml-2">dari bulan lalu</span>
                        </div>
                    </div>
                </div>

                <!-- Admin Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(251,146,60,0.1)] border border-slate-100 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-amber-50 rounded-full -mr-10 -mt-10"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 mb-1">Admin</p>
                                <p class="text-4xl font-extrabold text-slate-900">{{ App\Models\User::where('role', 'admin')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-slate-600 font-medium">Stabil</span>
                            <span class="text-slate-500 ml-2">tidak ada perubahan</span>
                        </div>
                    </div>
                </div>

                <!-- User Biasa Card -->
                <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(14,165,233,0.1)] border border-slate-100 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-50 rounded-full -mr-10 -mt-10"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 mb-1">User Biasa</p>
                                <p class="text-4xl font-extrabold text-slate-900">{{ App\Models\User::where('role', 'user')->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="text-emerald-600 font-medium">+15%</span>
                            <span class="text-slate-500 ml-2">dari bulan lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Panel -->
        <div class="fade-in-delay-2">
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Akses Cepat
                </h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Manajemen User -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="bg-white border border-slate-200 hover:border-blue-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Manajemen User</p>
                            <p class="text-xs text-slate-500">Kelola pengguna</p>
                        </div>
                    </a>

                    <!-- Role Switch -->
                    <a href="{{ route('admin.role-switch.index') }}" 
                       class="bg-white border border-slate-200 hover:border-amber-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-amber-50 rounded-lg flex items-center justify-center group-hover:bg-amber-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Role Switch</p>
                            <p class="text-xs text-slate-500">Ganti peran</p>
                        </div>
                    </a>

                    <!-- Soal TWK -->
                    <a href="{{ route('admin.soals.index', ['kategori' => 'TWK']) }}" 
                       class="bg-white border border-slate-200 hover:border-emerald-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center group-hover:bg-emerald-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Soal TWK</p>
                            <p class="text-xs text-slate-500">Wawasan kebangsaan</p>
                        </div>
                    </a>

                    <!-- Soal TIU -->
                    <a href="{{ route('admin.soals.index', ['kategori' => 'TIU']) }}" 
                       class="bg-white border border-slate-200 hover:border-purple-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center group-hover:bg-purple-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Soal TIU</p>
                            <p class="text-xs text-slate-500">Intelegensi umum</p>
                        </div>
                    </a>

                    <!-- Soal TKP -->
                    <a href="{{ route('admin.soals.index', ['kategori' => 'TKP']) }}" 
                       class="bg-white border border-slate-200 hover:border-cyan-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-cyan-50 rounded-lg flex items-center justify-center group-hover:bg-cyan-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Soal TKP</p>
                            <p class="text-xs text-slate-500">Karakteristik pribadi</p>
                        </div>
                    </a>

                    <!-- Upload CSV -->
                    <a href="{{ route('admin.soals.upload') }}" 
                       class="bg-white border border-slate-200 hover:border-green-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-green-50 rounded-lg flex items-center justify-center group-hover:bg-green-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Upload CSV</p>
                            <p class="text-xs text-slate-500">Import data</p>
                        </div>
                    </a>

                    <!-- Monitoring Hasil -->
                    <a href="{{ route('admin.monitoring-hasil') }}" 
                       class="bg-white border border-slate-200 hover:border-emerald-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-emerald-50 rounded-lg flex items-center justify-center group-hover:bg-emerald-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Monitoring Hasil</p>
                            <p class="text-xs text-slate-500">Pantau nilai & kelulusan</p>
                        </div>
                    </a>

                    <!-- Analytics -->
                    <a href="{{ route('admin.analytics') }}" 
                       class="bg-white border border-slate-200 hover:border-violet-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-violet-50 rounded-lg flex items-center justify-center group-hover:bg-violet-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Analytics</p>
                            <p class="text-xs text-slate-500">Analisis performa</p>
                        </div>
                    </a>

                    <!-- Download Template -->
                    <a href="{{ route('admin.soals.template') }}" 
                       class="bg-white border border-slate-200 hover:border-indigo-500 hover:shadow-md transition-all duration-300 rounded-xl p-4 flex items-center gap-3 text-slate-700 font-medium cursor-pointer group">
                        <div class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center group-hover:bg-indigo-100 transition-colors duration-200">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium">Template</p>
                            <p class="text-xs text-slate-500">Download format</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        @endsection
