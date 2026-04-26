<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestSession;

class DashboardController extends Controller
{
    /**
     * Show user dashboard.
     */
    public function userDashboard()
    {
        // Get all completed test sessions for current user
        $testSessions = TestSession::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->orderBy('finished_at', 'desc')
            ->get();

        // Calculate analytics by category
        $skorTWK = 0;
        $skorTIU = 0;
        $skorTKP = 0;
        $twkCount = 0;
        $tiuCount = 0;
        $tkpCount = 0;

        foreach ($testSessions as $session) {
            $maxSkor = $session->total_questions * 5;
            $percentage = $maxSkor > 0 ? ($session->score / $maxSkor) * 100 : 0;

            switch ($session->kategori) {
                case 'TWK':
                    $skorTWK += $percentage;
                    $twkCount++;
                    break;
                case 'TIU':
                    $skorTIU += $percentage;
                    $tiuCount++;
                    break;
                case 'TKP':
                    $skorTKP += $percentage;
                    $tkpCount++;
                    break;
            }
        }

        // Calculate averages
        $skorTWK = $twkCount > 0 ? round($skorTWK / $twkCount, 1) : 0;
        $skorTIU = $tiuCount > 0 ? round($skorTIU / $tiuCount, 1) : 0;
        $skorTKP = $tkpCount > 0 ? round($skorTKP / $tkpCount, 1) : 0;

        // Determine the lowest score for improvement suggestions
        $lowestScore = min($skorTWK, $skorTIU, $skorTKP);
        $lowestCategory = '';
        if ($lowestScore == $skorTWK && $twkCount > 0) {
            $lowestCategory = 'TWK';
        } elseif ($lowestScore == $skorTIU && $tiuCount > 0) {
            $lowestCategory = 'TIU';
        } elseif ($tkpCount > 0) {
            $lowestCategory = 'TKP';
        }

        return view('dashboard.user', compact(
            'testSessions',
            'skorTWK',
            'skorTIU',
            'skorTKP',
            'lowestScore',
            'lowestCategory',
            'twkCount',
            'tiuCount',
            'tkpCount'
        ));
    }

    /**
     * Show admin dashboard.
     */
    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    /**
     * Show test history page.
     */
    public function riwayatTes()
    {
        // Get all completed test sessions for current user
        $testSessions = TestSession::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->orderBy('finished_at', 'desc')
            ->get();

        // Update scores for all sessions to ensure accuracy
        foreach ($testSessions as $session) {
            $session->updateScore();
        }

        // Debug: Log the data we're fetching
        \Log::info('RiwayatTes - User ID: ' . auth()->id());
        \Log::info('RiwayatTes - Test sessions count: ' . $testSessions->count());
        
        foreach ($testSessions as $session) {
            \Log::info('Session data after update:', [
                'id' => $session->id,
                'kategori' => $session->kategori,
                'total_questions' => $session->total_questions,
                'score' => $session->score,
                'finished_at' => $session->finished_at,
                'status' => $session->status
            ]);
        }

        return view('riwayat.index', compact('testSessions'));
    }

    /**
     * Show monitoring hasil ujian for admin.
     */
    public function monitoringHasil(Request $request)
    {
        // Get all completed test sessions with eager loading
        $query = TestSession::with('user')
            ->where('status', 'completed')
            ->orderBy('finished_at', 'desc');

        // Apply category filter if exists
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Apply search filter if exists
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Paginate results
        $testSessions = $query->paginate(20)->withQueryString();

        // Get category options for filter dropdown
        $kategoriOptions = [
            'Semua' => 'Simulasi Full (SKD)',
            'TWK' => 'Tes Wawasan Kebangsaan',
            'TIU' => 'Tes Intelegensia Umum',
            'TKP' => 'Tes Karakteristik Pribadi'
        ];

        // Debug: Log the data we're fetching
        \Log::info('MonitoringHasil - Test sessions count: ' . $testSessions->count());
        \Log::info('MonitoringHasil - Filters:', [
            'kategori' => $request->kategori,
            'search' => $request->search
        ]);

        return view('admin.results.index', compact('testSessions', 'kategoriOptions'));
    }

    /**
     * Show detailed results for a specific test session.
     */
    public function showHasilDetail(TestSession $session)
    {
        // Load session with user relationship
        $session->load('user');

        // Get question IDs from test session
        if (is_string($session->answers)) {
            $answersData = json_decode($session->answers, true) ?? [];
        } else {
            $answersData = $session->answers ?? [];
        }
        
        $questionIds = $answersData['question_ids'] ?? [];
        $userAnswers = $answersData['user_answers'] ?? [];
        
        if (empty($questionIds)) {
            return redirect()->route('admin.monitoring-hasil')->with('error', 'Data soal tidak ditemukan untuk sesi tes ini.');
        }
        
        // Get questions for this session
        $questions = \App\Models\Soal::whereIn('id', $questionIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
            ->get();

        // Calculate detailed results
        $results = [];
        $correctCount = 0;
        
        foreach ($questions as $index => $question) {
            $userAnswer = $userAnswers[$index] ?? null;
            $isCorrect = $userAnswer === $question->jawaban_benar;
            
            if ($isCorrect) {
                $correctCount++;
            }
            
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->jawaban_benar,
                'is_correct' => $isCorrect,
            ];
        }

        $maxSkor = $session->total_questions * 5;
        $percentage = $maxSkor > 0 ? round(($session->score / $maxSkor) * 100, 1) : 0;
        $passed = $percentage >= 65;

        return view('admin.results.show', compact('session', 'results', 'correctCount', 'percentage', 'passed'));
    }

    /**
     * Display advanced analytics dashboard for admin.
     */
    public function analytics()
    {
        // Get overall statistics
        $totalUsers = \App\Models\User::count();
        $totalSoal = \App\Models\Soal::count();
        $totalTestSessions = \App\Models\TestSession::count();
        $completedTests = \App\Models\TestSession::where('status', 'completed')->count();
        
        // Get category-wise statistics
        $soalByCategory = \App\Models\Soal::selectRaw('kategori, COUNT(*) as count')
            ->groupBy('kategori')
            ->pluck('count', 'kategori')
            ->toArray();
        
        $testsByCategory = \App\Models\TestSession::selectRaw('kategori, COUNT(*) as count')
            ->where('status', 'completed')
            ->groupBy('kategori')
            ->pluck('count', 'kategori')
            ->toArray();
        
        // Get average scores by category
        $avgScoresByCategory = \App\Models\TestSession::selectRaw('kategori, AVG(score) as avg_score, AVG(score/total_questions*100) as avg_percentage')
            ->where('status', 'completed')
            ->groupBy('kategori')
            ->get()
            ->keyBy('kategori');
        
        // Get pass/fail rates by category
        $passFailByCategory = [];
        foreach (['TWK', 'TIU', 'TKP'] as $category) {
            $categoryTests = \App\Models\TestSession::where('kategori', $category)
                ->where('status', 'completed')
                ->get();
            
            $passed = $categoryTests->filter(function($session) {
                return $session->total_questions > 0 && ($session->score / $session->total_questions * 100) >= 65;
            })->count();
            
            $passFailByCategory[$category] = [
                'total' => $categoryTests->count(),
                'passed' => $passed,
                'failed' => $categoryTests->count() - $passed,
                'pass_rate' => $categoryTests->count() > 0 ? round(($passed / $categoryTests->count()) * 100, 1) : 0
            ];
        }
        
        // Get monthly test statistics (last 6 months)
        $monthlyStats = \App\Models\TestSession::selectRaw('DATE_FORMAT(finished_at, "%Y-%m") as month, COUNT(*) as total_tests, AVG(score) as avg_score')
            ->where('status', 'completed')
            ->where('finished_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        
        // Get top performers
        $topPerformers = \App\Models\TestSession::with('user')
            ->where('status', 'completed')
            ->selectRaw('user_id, AVG(score/total_questions*100) as avg_percentage, COUNT(*) as tests_taken')
            ->groupBy('user_id')
            ->having('tests_taken', '>=', 3)
            ->orderBy('avg_percentage', 'desc')
            ->limit(10)
            ->get();
        
        // Get recent test activity
        $recentTests = \App\Models\TestSession::with('user')
            ->where('status', 'completed')
            ->orderBy('finished_at', 'desc')
            ->limit(10)
            ->get();
        
        // Get difficulty distribution (if difficulty field exists)
        $difficultyDistribution = [];
        if (\Schema::hasColumn('soals', 'difficulty')) {
            $difficultyDistribution = \App\Models\Soal::selectRaw('difficulty, COUNT(*) as count')
                ->groupBy('difficulty')
                ->pluck('count', 'difficulty')
                ->toArray();
        }
        
        return view('admin.analytics.index', compact(
            'totalUsers',
            'totalSoal', 
            'totalTestSessions',
            'completedTests',
            'soalByCategory',
            'testsByCategory',
            'avgScoresByCategory',
            'passFailByCategory',
            'monthlyStats',
            'topPerformers',
            'recentTests',
            'difficultyDistribution'
        ));
    }
}
