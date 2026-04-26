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
        return view('dashboard.user');
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

        // Debug: Log the data we're fetching
        \Log::info('RiwayatTes - User ID: ' . auth()->id());
        \Log::info('RiwayatTes - Test sessions count: ' . $testSessions->count());
        
        foreach ($testSessions as $session) {
            \Log::info('Session data:', [
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
        $testSessions = $query->paginate(20);

        // Get category options for filter dropdown
        $kategoriOptions = [
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
}
