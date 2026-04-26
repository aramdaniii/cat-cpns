<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori',
        'total_questions',
        'current_question',
        'answers',
        'score',
        'started_at',
        'ends_at',
        'finished_at',
        'status',
    ];

    protected $casts = [
        'answers' => 'array',
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
        'finished_at' => 'datetime',
        'score' => 'integer',
        'total_questions' => 'integer',
        'current_question' => 'integer',
    ];

    /**
     * Get the user that owns the test session.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get current answer for the current question
     */
    public function getCurrentAnswer()
    {
        if (is_string($this->answers)) {
            $answersData = json_decode($this->answers, true) ?? [];
        } else {
            $answersData = $this->answers ?? [];
        }
        $userAnswers = $answersData['user_answers'] ?? [];
        return $userAnswers[$this->current_question] ?? null;
    }

    /**
     * Set answer for current question
     */
    public function setAnswer($questionNumber, $answer)
    {
        if (is_string($this->answers)) {
            $answersData = json_decode($this->answers, true) ?? [];
        } else {
            $answersData = $this->answers ?? [];
        }
        $answersData['user_answers'][$questionNumber] = $answer;
        $this->answers = json_encode($answersData);
        $this->save();
    }

    /**
     * Check if question is answered
     */
    public function isQuestionAnswered($questionNumber)
    {
        if (is_string($this->answers)) {
            $answersData = json_decode($this->answers, true) ?? [];
        } else {
            $answersData = $this->answers ?? [];
        }
        
        // Handle new format with user_answers
        if (isset($answersData['user_answers'])) {
            $userAnswers = $answersData['user_answers'];
            return isset($userAnswers[$questionNumber]) && !empty($userAnswers[$questionNumber]);
        }
        
        // Handle legacy format (direct array)
        return isset($answersData[$questionNumber]) && !empty($answersData[$questionNumber]);
    }

    /**
     * Get answered questions count
     */
    public function getAnsweredCount()
    {
        if (is_string($this->answers)) {
            $answersData = json_decode($this->answers, true) ?? [];
        } else {
            $answersData = $this->answers ?? [];
        }
        $userAnswers = $answersData['user_answers'] ?? [];
        return count($userAnswers);
    }

    /**
     * Check if test is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Calculate score
     */
    public function calculateScore()
    {
        // Always recalculate score to ensure accuracy

        $correctAnswers = 0;
        
        // Get answers data
        if (is_string($this->answers)) {
            $answersData = json_decode($this->answers, true) ?? [];
        } else {
            $answersData = $this->answers ?? [];
        }
        
        \Log::info('Calculate score - Answers data:', $answersData);
        
        // Handle new format
        if (isset($answersData['question_ids']) && isset($answersData['user_answers'])) {
            $questionIds = $answersData['question_ids'];
            $userAnswers = $answersData['user_answers'];
            
            \Log::info('Calculate score - New format - Question IDs:', $questionIds);
            \Log::info('Calculate score - New format - User answers:', $userAnswers);
            
            // Get questions for this session
            $questions = Soal::whereIn('id', $questionIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
                ->get();
                
            foreach ($questions as $index => $question) {
                $userAnswer = $userAnswers[$index] ?? null;
                \Log::info('Question ' . $index . ': User=' . $userAnswer . ', Correct=' . $question->jawaban_benar . ', Match=' . ($userAnswer === $question->jawaban_benar ? 'YES' : 'NO'));
                
                // Normalize both answers for comparison (trim whitespace and uppercase)
                $normalizedUserAnswer = $userAnswer ? strtoupper(trim($userAnswer)) : null;
                $normalizedCorrectAnswer = strtoupper(trim($question->jawaban_benar));
                
                // TKP uses point-based scoring
                if ($this->kategori === 'TKP' && $normalizedUserAnswer) {
                    $poinColumn = 'poin_' . strtolower($normalizedUserAnswer);
                    $correctAnswers += $question->$poinColumn ?? 0;
                } else {
                    // TWK/TIU uses correct/incorrect scoring (5 points per correct answer)
                    if ($normalizedUserAnswer === $normalizedCorrectAnswer) {
                        $correctAnswers += 5;
                    }
                }
            }
        } else {
            // Handle legacy format
            $answers = $answersData;
            \Log::info('Calculate score - Legacy format - Answers:', $answers);
            
            $questions = Soal::byKategori($this->kategori)
                ->orderBy('id')
                ->take($this->total_questions)
                ->get();

            foreach ($questions as $index => $question) {
                if (isset($answers[$index])) {
                    // Normalize both answers for comparison (trim whitespace and uppercase)
                    $normalizedUserAnswer = strtoupper(trim($answers[$index]));
                    $normalizedCorrectAnswer = strtoupper(trim($question->jawaban_benar));
                    
                    // TKP uses point-based scoring
                    if ($this->kategori === 'TKP' && $normalizedUserAnswer) {
                        $poinColumn = 'poin_' . strtolower($normalizedUserAnswer);
                        $correctAnswers += $question->$poinColumn ?? 0;
                    } else {
                        // TWK/TIU uses correct/incorrect scoring (5 points per correct answer)
                        if ($normalizedUserAnswer === $normalizedCorrectAnswer) {
                            $correctAnswers += 5;
                        }
                    }
                }
            }
        }

        \Log::info('Calculate score - Final result: ' . $correctAnswers . ' correct out of ' . $this->total_questions);
        return $correctAnswers;
    }

    /**
     * Update score in database for completed tests
     */
    public function updateScore()
    {
        if (!$this->isCompleted()) {
            return false;
        }
        
        $calculatedScore = $this->calculateScore();
        if ($this->score !== $calculatedScore) {
            $this->score = $calculatedScore;
            $this->save();
            \Log::info('Score updated for session ' . $this->id . ': ' . $this->score);
        }
        return $this->score;
    }

    /**
     * Get progress percentage
     */
    public function getProgressPercentage()
    {
        if ($this->total_questions === 0) {
            return 0;
        }

        return ($this->getAnsweredCount() / $this->total_questions) * 100;
    }

    /**
     * Get remaining questions
     */
    public function getRemainingQuestions()
    {
        return $this->total_questions - $this->getAnsweredCount();
    }

    /**
     * Complete the test
     */
    public function complete()
    {
        $this->status = 'completed';
        $this->finished_at = now();
        $calculatedScore = $this->calculateScore();
        \Log::info('Test completion - Session ID: ' . $this->id . ', Calculated score: ' . $calculatedScore);
        $this->score = $calculatedScore;
        $this->save();
        
        // Double-check the score was saved correctly
        \Log::info('Test completion - Saved score: ' . $this->fresh()->score);
        
        // Create test completion notification
        \App\Http\Controllers\NotificationController::createTestCompletedNotification($this);
        
        // Create certificate if user passed
        $percentage = $this->total_questions > 0 ? ($this->score / $this->total_questions) * 100 : 0;
        if ($percentage >= 65) {
            $certificate = \App\Http\Controllers\CertificateController::generateForTestSession($this);
            if ($certificate) {
                \App\Http\Controllers\NotificationController::createCertificateIssuedNotification($certificate);
            }
        }
    }

    /**
     * Start timer for current question
     */
    public function startQuestionTimer()
    {
        if ($this->timer_enabled) {
            $this->question_started_at = now();
            $this->time_remaining = $this->time_per_question;
            $this->save();
        }
    }

    /**
     * Get remaining time for current question
     */
    public function getRemainingTime()
    {
        if (!$this->timer_enabled || !$this->question_started_at) {
            return $this->time_per_question;
        }

        $elapsed = now()->diffInSeconds($this->question_started_at);
        $remaining = $this->time_per_question - $elapsed;
        
        return max(0, $remaining);
    }

    /**
     * Check if time is up for current question
     */
    public function isTimeUp()
    {
        return $this->getRemainingTime() <= 0;
    }

    /**
     * Pause timer
     */
    public function pauseTimer()
    {
        if ($this->timer_enabled && $this->question_started_at) {
            $this->time_remaining = $this->getRemainingTime();
            $this->question_started_at = null;
            $this->save();
        }
    }

    /**
     * Resume timer
     */
    public function resumeTimer()
    {
        if ($this->timer_enabled && $this->time_remaining > 0) {
            $this->question_started_at = now()->subSeconds($this->time_per_question - $this->time_remaining);
            $this->save();
        }
    }

    /**
     * Auto-submit answer when time is up
     */
    public function autoSubmit()
    {
        // Move to next question without saving answer
        if ($this->current_question < $this->total_questions - 1) {
            $this->current_question++;
            $this->question_started_at = null;
            $this->time_remaining = null;
            $this->save();
            return 'next';
        } else {
            // Complete test
            $this->complete();
            return 'complete';
        }
    }

    /**
     * Extend timer for emergency situations
     */
    public function extendTimer($seconds = 300)
    {
        if ($this->allow_extension && $this->max_extensions > 0) {
            $this->time_extension += $seconds;
            $this->time_remaining += $seconds;
            $this->max_extensions--;
            $this->save();
            return true;
        }
        return false;
    }

    /**
     * Check if warning should be sent
     */
    public function shouldSendWarning($threshold)
    {
        $remaining = $this->getRemainingTime();
        
        switch ($threshold) {
            case '5min':
                return !$this->warning_5min_sent && $remaining <= 300 && $remaining > 60;
            case '1min':
                return !$this->warning_1min_sent && $remaining <= 60 && $remaining > 30;
            case '30sec':
                return !$this->warning_30sec_sent && $remaining <= 30;
            default:
                return false;
        }
    }

    /**
     * Mark warning as sent
     */
    public function markWarningSent($threshold)
    {
        switch ($threshold) {
            case '5min':
                $this->warning_5min_sent = true;
                break;
            case '1min':
                $this->warning_1min_sent = true;
                break;
            case '30sec':
                $this->warning_30sec_sent = true;
                break;
        }
        $this->save();
    }

    /**
     * Get total test duration including extensions
     */
    public function getTotalDuration()
    {
        $baseDuration = $this->total_questions * $this->time_per_question;
        return $baseDuration + $this->time_extension;
    }

    /**
     * Get timer statistics
     */
    public function getTimerStats()
    {
        return [
            'total_duration' => $this->getTotalDuration(),
            'time_remaining' => $this->getRemainingTime(),
            'time_used' => $this->getTotalDuration() - $this->getRemainingTime(),
            'extensions_used' => $this->time_extension,
            'total_pause_duration' => $this->total_pause_duration,
            'pause_count' => $this->last_pause_at ? 1 : 0, // Simplified for now
            'warnings_sent' => [
                '5min' => $this->warning_5min_sent,
                '1min' => $this->warning_1min_sent,
                '30sec' => $this->warning_30sec_sent,
            ]
        ];
    }
}
