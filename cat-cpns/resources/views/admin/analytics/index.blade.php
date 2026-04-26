@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

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
    .chart-container {
        max-height: 320px;
        position: relative;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="fade-in">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Analytics Dashboard</h1>
                <p class="text-slate-600 mt-2">Statistik lengkap dan insight performa CAT CPNS</p>
            </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->

        <!-- Overview Stats -->
        <div class="fade-in-delay-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Total Users</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($totalUsers) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(34,197,94,0.1)] border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Total Soal</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($totalSoal) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-question-circle text-emerald-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(251,146,60,0.1)] border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Tes Selesai</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($completedTests) }}</p>
                        <p class="text-xs text-slate-500">dari {{ number_format($totalTestSessions) }} total</p>
                    </div>
                    <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clipboard-check text-amber-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(239,68,68,0.1)] border border-slate-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-600 mb-1">Completion Rate</p>
                        <p class="text-3xl font-bold text-slate-900">
                            {{ $totalTestSessions > 0 ? round(($completedTests / $totalTestSessions) * 100, 1) : 0 }}%
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="fade-in-delay-2 grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Category Distribution Chart -->
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Distribusi Kategori</h2>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
            
            <!-- Pass/Fail Rate Chart -->
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Tingkat Kelulusan per Kategori</h2>
                <div class="chart-container">
                    <canvas id="passFailChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Trends -->
        <div class="fade-in-delay-2 bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6 mb-8">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">Tren Tes Bulanan (6 Bulan Terakhir)</h2>
            <div class="chart-container max-h-96">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Top Performers & Recent Activity -->
        <div class="fade-in-delay-3 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Top Performers -->
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Top Performers</h2>
                <div class="space-y-3">
                    @forelse($topPerformers as $performer)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">
                                        {{ strtoupper(substr($performer->user->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900">{{ $performer->user->name }}</p>
                                    <p class="text-xs text-slate-600">{{ $performer->tests_taken }} tes</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-emerald-600">{{ number_format($performer->avg_percentage, 1) }}%</p>
                                <p class="text-xs text-slate-600">avg score</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-center py-4">Belum ada data performer</p>
                    @endforelse
                </div>
            </div>
            
            <!-- Recent Test Activity -->
            <div class="bg-white rounded-2xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-slate-100 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Aktivitas Tes Terbaru</h2>
                <div class="space-y-3">
                    @forelse($recentTests as $test)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">
                                        {{ strtoupper(substr($test->user->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-900">{{ $test->user->name }}</p>
                                    <p class="text-xs text-slate-600">{{ $test->kategori }} - {{ $test->finished_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                @php
                                    $maxSkor = $test->total_questions * 5;
                                    $percentage = $maxSkor > 0 ? round(($test->score / $maxSkor) * 100, 1) : 0;
                                    $passed = $percentage >= 65;
                                @endphp
                                <p class="font-bold {{ $passed ? 'text-emerald-600' : 'text-red-600' }}">{{ number_format($percentage, 1) }}%</p>
                                <p class="text-xs text-slate-600">{{ $passed ? 'LULUS' : 'TIDAK LULUS' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 text-center py-4">Belum ada aktivitas tes</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    <script>
        // Category Distribution Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['TWK', 'TIU', 'TKP'],
                datasets: [{
                    data: [
                        {{ $soalByCategory['TWK'] ?? 0 }},
                        {{ $soalByCategory['TIU'] ?? 0 }},
                        {{ $soalByCategory['TKP'] ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(251, 146, 60, 0.8)',
                        'rgba(6, 182, 212, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(251, 146, 60, 1)',
                        'rgba(6, 182, 212, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Pass/Fail Rate Chart
        const passFailCtx = document.getElementById('passFailChart').getContext('2d');
        new Chart(passFailCtx, {
            type: 'bar',
            data: {
                labels: ['TWK', 'TIU', 'TKP'],
                datasets: [{
                    label: 'Lulus',
                    data: [
                        {{ $passFailByCategory['TWK']['passed'] ?? 0 }},
                        {{ $passFailByCategory['TIU']['passed'] ?? 0 }},
                        {{ $passFailByCategory['TKP']['passed'] ?? 0 }}
                    ],
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 2
                }, {
                    label: 'Tidak Lulus',
                    data: [
                        {{ $passFailByCategory['TWK']['failed'] ?? 0 }},
                        {{ $passFailByCategory['TIU']['failed'] ?? 0 }},
                        {{ $passFailByCategory['TKP']['failed'] ?? 0 }}
                    ],
                    backgroundColor: 'rgba(239, 68, 68, 0.8)',
                    borderColor: 'rgba(239, 68, 68, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Monthly Trends Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($monthlyStats as $stat)
                        '{{ \Carbon\Carbon::parse($stat->month . '-01')->format('M Y') }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Jumlah Tes',
                    data: [
                        @foreach($monthlyStats as $stat)
                            {{ $stat->total_tests }},
                        @endforeach
                    ],
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    yAxisID: 'y'
                }, {
                    label: 'Rata-rata Skor',
                    data: [
                        @foreach($monthlyStats as $stat)
                            {{ round($stat->avg_score, 1) }},
                        @endforeach
                    ],
                    borderColor: 'rgba(34, 197, 94, 1)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    yAxisID: 'y1'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Tes'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Rata-rata Skor'
                        },
                        grid: {
                            drawOnChartArea: false,
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
@endsection
