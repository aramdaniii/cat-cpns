<?php

namespace App\Http\Controllers;

use App\Models\TestSession;
use App\Models\Soal;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Show test selection page
     */
    public function index()
    {
        $kategoriOptions = Soal::getKategoriOptions();
        $kategoriOptions['Semua'] = 'Semua Kategori (Simulasi Full)';
        
        return view('test.index', compact('kategoriOptions'));
    }

    /**
     * Start a new test session
     */
    public function start(Request $request)
    {
        try {
            // Basic validation
            $validated = $request->validate([
                'kategori' => ['required', 'in:TWK,TIU,TKP,Semua'],
                'jumlah_soal' => ['required', 'integer', 'min:15', 'max:150'],
            ]);

            // Check if user has an active test session
            $activeSession = TestSession::where('user_id', auth()->id())
                ->where('status', 'in_progress')
                ->first();

            if ($activeSession) {
                return redirect()->route('test.take', ['session' => $activeSession->id])
                    ->with('info', 'Anda memiliki tes yang sedang berjalan. Melanjutkan tes yang ada.');
            }

            // Get random questions for the test
            if ($validated['kategori'] === 'Semua') {
                // Distribusi soal sesuai standar SKD BKN
                if ($validated['jumlah_soal'] == 110) {
                    // Standar SKD: 30 TWK, 35 TIU, 45 TKP
                    $twkCount = 30;
                    $tiuCount = 35;
                    $tkpCount = 45;
                } else {
                    // Pembagian proporsional untuk jumlah soal lain
                    // TWK: 27%, TIU: 32%, TKP: 41%
                    $twkCount = round($validated['jumlah_soal'] * 0.27);
                    $tiuCount = round($validated['jumlah_soal'] * 0.32);
                    $tkpCount = $validated['jumlah_soal'] - $twkCount - $tiuCount; // Sisa ke TKP
                }
                
                $twkQuestions = Soal::byKategori('TWK')
                    ->inRandomOrder()
                    ->take($twkCount)
                    ->get();
                
                $tiuQuestions = Soal::byKategori('TIU')
                    ->inRandomOrder()
                    ->take($tiuCount)
                    ->get();
                
                $tkpQuestions = Soal::byKategori('TKP')
                    ->inRandomOrder()
                    ->take($tkpCount)
                    ->get();
                
                // Merge in order: TWK -> TIU -> TKP (no shuffle)
                $questions = $twkQuestions->concat($tiuQuestions)->concat($tkpQuestions);
                
                // If total is less than requested, take more from available categories
                if ($questions->count() < $validated['jumlah_soal']) {
                    $needed = $validated['jumlah_soal'] - $questions->count();
                    $additionalQuestions = Soal::whereIn('kategori', ['TWK', 'TIU', 'TKP'])
                        ->whereNotIn('id', $questions->pluck('id'))
                        ->inRandomOrder()
                        ->take($needed)
                        ->get();
                    $questions = $questions->concat($additionalQuestions);
                }
                
                // Trim to exact requested amount
                $questions = $questions->take($validated['jumlah_soal']);
            } else {
                // Original logic for single category
                $questions = Soal::byKategori($validated['kategori'])
                    ->inRandomOrder()
                    ->take($validated['jumlah_soal'])
                    ->get();
            }

            if ($questions->count() < $validated['jumlah_soal']) {
                return back()->with('error', 'Jumlah soal yang tersedia tidak mencukupi. Tersedia: ' . $questions->count() . ' soal.');
            }

            // Create new test session
            $durasi = round(($validated['jumlah_soal'] / 110) * 100); // Standar SKD: 110 soal = 100 menit
            $endTime = now()->addMinutes($durasi); // Waktu berakhir absolut
            $session = TestSession::create([
                'user_id' => auth()->id(),
                'kategori' => $validated['kategori'],
                'total_questions' => $questions->count(),
                'current_question' => 0,
                'answers' => [],
                'status' => 'in_progress',
                'started_at' => now(),
                'ends_at' => $endTime, // Waktu berakhir absolut
                'time_per_question' => 60, // 60 detik per soal
                'timer_enabled' => true,
            ]);

            // Store question IDs in the test session itself
            $session->update([
                'answers' => json_encode([
                    'question_ids' => $questions->pluck('id')->toArray(),
                    'user_answers' => []
                ])
            ]);

            return redirect()->route('test.take', ['session' => $session->id]);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Take the test
     */
    public function take(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if session is completed
        if ($session->isCompleted()) {
            return redirect()->route('test.result', ['session' => $session->id]);
        }

        // Get question IDs from test session
        if (is_string($session->answers)) {
            $answersData = json_decode($session->answers, true) ?? [];
        } else {
            $answersData = $session->answers ?? [];
        }
        
        // Check if this is a legacy session (old format)
        if (!isset($answersData['question_ids'])) {
            // For legacy sessions, regenerate questions
            $questions = Soal::byKategori($session->kategori)
                ->inRandomOrder()
                ->take($session->total_questions)
                ->get();
                
            if ($questions->count() < $session->total_questions) {
                return redirect()->route('test.index')->with('error', 'Jumlah soal yang tersedia tidak mencukupi.');
            }
            
            // Update session with new format
            $session->update([
                'answers' => json_encode([
                    'question_ids' => $questions->pluck('id')->toArray(),
                    'user_answers' => []
                ])
            ]);
            
            $questionIds = $questions->pluck('id')->toArray();
        } else {
            $questionIds = $answersData['question_ids'];
        }
        
        if (empty($questionIds)) {
            return redirect()->route('test.index')->with('error', 'Sesi tes tidak valid. Question IDs kosong.');
        }

        $currentQuestionId = $questionIds[$session->current_question] ?? null;
        $currentQuestion = Soal::find($currentQuestionId);

        if (!$currentQuestion) {
            return redirect()->route('test.index')->with('error', 'Soal tidak ditemukan.');
        }

        // Get all questions for sidebar
        $allQuestions = Soal::whereIn('id', $questionIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
            ->get();

        // Start timer for this question
        if ($session->timer_enabled && !$session->question_started_at) {
            $session->startQuestionTimer();
        }

        // Get absolute end time for JavaScript
        $endTime = $session->ends_at;

        return view('test.take', compact('session', 'currentQuestion', 'allQuestions', 'endTime'));
    }

    /**
     * Save answer and move to next question
     */
    public function answer(Request $request, TestSession $session)
    {
        $request->validate([
            'answer' => ['required', 'in:A,B,C,D,E'],
        ]);

        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        // Save answer
        $session->setAnswer($session->current_question, $request->answer);

        // Move to next question or complete test
        if ($session->current_question < $session->total_questions - 1) {
            $session->current_question++;
            $session->save();
            return redirect()->route('test.take', ['session' => $session->id]);
        } else {
            // Complete the test
            $session->complete();
            return redirect()->route('test.result', ['session' => $session->id]);
        }
    }

    /**
     * Handle timer auto-submit
     */
    public function autoSubmit(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        $result = $session->autoSubmit();
        
        if ($result === 'next') {
            return redirect()->route('test.take', ['session' => $session->id]);
        } else {
            return redirect()->route('test.result', ['session' => $session->id]);
        }
    }

    /**
     * Pause timer
     */
    public function pauseTimer(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        $session->pauseTimer();
        return response()->json(['success' => true]);
    }

    /**
     * Resume timer
     */
    public function resumeTimer(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        $session->resumeTimer();
        return response()->json(['success' => true]);
    }

    /**
     * Navigate to specific question
     */
    public function navigate(Request $request, TestSession $session)
    {
        $request->validate([
            'question_number' => ['required', 'integer', 'min:0'],
        ]);

        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        $questionNumber = $request->question_number;

        if ($questionNumber < 0 || $questionNumber >= $session->total_questions) {
            return back()->with('error', 'Nomor soal tidak valid.');
        }

        $session->current_question = $questionNumber;
        $session->save();

        return redirect()->route('test.take', ['session' => $session->id]);
    }

    /**
     * Show test results
     */
    public function result(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$session->isCompleted()) {
            return redirect()->route('test.take', ['session' => $session->id]);
        }

        // Get question IDs from test session
        if (is_string($session->answers)) {
            $answersData = json_decode($session->answers, true) ?? [];
        } else {
            $answersData = $session->answers ?? [];
        }
        
        $questionIds = $answersData['question_ids'] ?? [];
        $userAnswers = $answersData['user_answers'] ?? [];
        
        if (empty($questionIds)) {
            return redirect()->route('test.index')->with('error', 'Data soal tidak ditemukan untuk sesi tes ini.');
        }
        
        $questions = Soal::whereIn('id', $questionIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
            ->get();

        // Calculate detailed results
        $results = [];
        
        foreach ($questions as $index => $question) {
            $userAnswer = $userAnswers[$index] ?? null;
            $isCorrect = $userAnswer === $question->jawaban_benar;
            
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->jawaban_benar,
                'is_correct' => $isCorrect,
            ];
        }

        // Generate certificate if user passed the test
        $certificate = null;
        if ($session->status === 'completed') {
            $percentage = $session->total_questions > 0 ? ($session->score / $session->total_questions) * 100 : 0;
            if ($percentage >= 65) {
                $certificate = \App\Http\Controllers\CertificateController::generateForTestSession($session);
            }
        }

        return view('test.result', compact('session', 'results', 'certificate'));
    }

    /**
     * Extend timer for emergency situations
     */
    public function extendTimer(Request $request, TestSession $session)
    {
        $request->validate([
            'seconds' => ['required', 'integer', 'min:60', 'max:1800'], // 1min to 30min
        ]);

        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        $seconds = $request->seconds;
        $success = $session->extendTimer($seconds);

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => "Timer diperpanjang {$seconds} detik",
                'time_remaining' => $session->getRemainingTime(),
                'extensions_remaining' => $session->max_extensions
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat memperpanjang timer. Batas perpanjangan telah tercapai.'
            ], 400);
        }
    }

    /**
     * Get timer statistics
     */
    public function getTimerStats(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        return response()->json([
            'stats' => $session->getTimerStats(),
            'warnings' => [
                'should_send_5min' => $session->shouldSendWarning('5min'),
                'should_send_1min' => $session->shouldSendWarning('1min'),
                'should_send_30sec' => $session->shouldSendWarning('30sec'),
            ]
        ]);
    }

    /**
     * Cancel test session
     */
    public function cancel(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            abort(403);
        }

        if ($session->isCompleted()) {
            return back()->with('error', 'Tes sudah selesai, tidak dapat dibatalkan.');
        }

        $session->delete();
        session()->forget('test_questions_' . $session->id);

        return redirect()->route('test.index')->with('success', 'Tes berhasil dibatalkan.');
    }

    /**
     * Auto-save answer in background
     */
    public function autoSave(Request $request)
    {
        $request->validate([
            'session_id' => ['required', 'exists:test_sessions,id'],
            'question_index' => ['required', 'integer', 'min:0'],
            'answer' => ['required', 'in:A,B,C,D,E'],
        ]);

        $session = TestSession::find($request->session_id);

        // Check if session belongs to user
        if ($session->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Check if session is still in progress
        if ($session->isCompleted()) {
            return response()->json(['success' => false, 'message' => 'Test already completed'], 400);
        }

        // Save answer
        $session->setAnswer($request->question_index, $request->answer);
        $session->save();

        return response()->json(['success' => true, 'message' => 'Answer saved']);
    }
}
