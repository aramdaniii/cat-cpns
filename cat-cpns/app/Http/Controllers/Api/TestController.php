<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TestSession;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    /**
     * Get user's test sessions
     */
    public function sessions()
    {
        $sessions = Auth::user()->testSessions()
            ->with(['soals'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $sessions->items(),
            'pagination' => [
                'current_page' => $sessions->currentPage(),
                'last_page' => $sessions->lastPage(),
                'per_page' => $sessions->perPage(),
                'total' => $sessions->total(),
            ]
        ]);
    }

    /**
     * Start a new test session
     */
    public function start(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => ['required', 'in:TWK,TIU,TKP'],
            'jumlah_soal' => ['required', 'integer', 'min:5', 'max:50'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if user has an active session
        $activeSession = Auth::user()->testSessions()
            ->where('status', 'active')
            ->first();

        if ($activeSession) {
            return response()->json([
                'success' => false,
                'message' => 'You have an active test session',
                'data' => [
                    'session_id' => $activeSession->id,
                    'current_question' => $activeSession->current_question,
                    'total_questions' => $activeSession->total_questions,
                    'kategori' => $activeSession->kategori,
                ]
            ], 422);
        }

        // Get random questions
        $questions = Soal::where('kategori', $request->kategori)
            ->inRandomOrder()
            ->take($request->jumlah_soal)
            ->get();

        if ($questions->count() < $request->jumlah_soal) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough questions available'
            ], 422);
        }

        // Create test session
        $session = TestSession::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'total_questions' => $questions->count(),
            'current_question' => 0,
            'status' => 'active',
            'answers' => [
                'question_ids' => $questions->pluck('id')->toArray(),
                'user_answers' => array_fill(0, $questions->count(), null),
            ],
            'started_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Test started successfully',
            'data' => [
                'session_id' => $session->id,
                'total_questions' => $session->total_questions,
                'kategori' => $session->kategori,
                'started_at' => $session->started_at,
            ]
        ]);
    }

    /**
     * Get questions for a test session
     */
    public function questions(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($session->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Test session is not active'
            ], 422);
        }

        $answersData = is_string($session->answers) 
            ? json_decode($session->answers, true) ?? []
            : $session->answers ?? [];

        $questionIds = $answersData['question_ids'] ?? [];
        $userAnswers = $answersData['user_answers'] ?? [];

        $questions = Soal::whereIn('id', $questionIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
            ->get();

        $questionData = $questions->map(function ($question, $index) use ($userAnswers) {
            return [
                'id' => $question->id,
                'number' => $index + 1,
                'pertanyaan' => $question->pertanyaan,
                'pilihan_a' => $question->pilihan_a,
                'pilihan_b' => $question->pilihan_b,
                'pilihan_c' => $question->pilihan_c,
                'pilihan_d' => $question->pilihan_d,
                'kategori' => $question->kategori,
                'difficulty' => $question->difficulty ?? 'sedang',
                'user_answer' => $userAnswers[$index] ?? null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'session_id' => $session->id,
                'current_question' => $session->current_question,
                'total_questions' => $session->total_questions,
                'kategori' => $session->kategori,
                'started_at' => $session->started_at,
                'questions' => $questionData,
            ]
        ]);
    }

    /**
     * Submit answer for a question
     */
    public function answer(Request $request, TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($session->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Test session is not active'
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'question_number' => ['required', 'integer', 'min:0'],
            'answer' => ['required', 'in:A,B,C,D'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $questionNumber = $request->question_number;
        $answer = $request->answer;

        if ($questionNumber >= $session->total_questions) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid question number'
            ], 422);
        }

        // Update answers
        $answersData = is_string($session->answers) 
            ? json_decode($session->answers, true) ?? []
            : $session->answers ?? [];

        $answersData['user_answers'][$questionNumber] = $answer;
        $session->answers = $answersData;
        $session->current_question = $questionNumber + 1;
        $session->save();

        return response()->json([
            'success' => true,
            'message' => 'Answer submitted successfully',
            'data' => [
                'current_question' => $session->current_question,
                'is_last_question' => $session->current_question >= $session->total_questions,
            ]
        ]);
    }

    /**
     * Complete test session
     */
    public function complete(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($session->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Test session is not active'
            ], 422);
        }

        $session->complete();

        return response()->json([
            'success' => true,
            'message' => 'Test completed successfully',
            'data' => [
                'session_id' => $session->id,
                'status' => $session->status,
                'finished_at' => $session->finished_at,
            ]
        ]);
    }

    /**
     * Get test result
     */
    public function result(TestSession $session)
    {
        // Check if session belongs to user
        if ($session->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($session->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Test session is not completed'
            ], 422);
        }

        $answersData = is_string($session->answers) 
            ? json_decode($session->answers, true) ?? []
            : $session->answers ?? [];

        $questionIds = $answersData['question_ids'] ?? [];
        $userAnswers = $answersData['user_answers'] ?? [];

        $questions = Soal::whereIn('id', $questionIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
            ->get();

        $results = [];
        $correctCount = 0;

        foreach ($questions as $index => $question) {
            $userAnswer = $userAnswers[$index] ?? null;
            $isCorrect = $userAnswer === $question->jawaban_benar;

            if ($isCorrect) {
                $correctCount++;
            }

            $results[] = [
                'question_number' => $index + 1,
                'pertanyaan' => $question->pertanyaan,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->jawaban_benar,
                'is_correct' => $isCorrect,
                'pilihan_a' => $question->pilihan_a,
                'pilihan_b' => $question->pilihan_b,
                'pilihan_c' => $question->pilihan_c,
                'pilihan_d' => $question->pilihan_d,
            ];
        }

        $percentage = $session->total_questions > 0 ? round(($correctCount / $session->total_questions) * 100, 1) : 0;
        $passed = $percentage >= 65;

        return response()->json([
            'success' => true,
            'data' => [
                'session_id' => $session->id,
                'kategori' => $session->kategori,
                'total_questions' => $session->total_questions,
                'correct_answers' => $correctCount,
                'score' => $session->score,
                'percentage' => $percentage,
                'passed' => $passed,
                'started_at' => $session->started_at,
                'finished_at' => $session->finished_at,
                'results' => $results,
            ]
        ]);
    }
}
