<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_session_id',
        'certificate_number',
        'title',
        'description',
        'score',
        'percentage',
        'category',
        'total_questions',
        'correct_answers',
        'twk_score',
        'tiu_score',
        'tkp_score',
        'issued_at',
        'expires_at',
        'status',
        'verification_code',
        'metadata',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'expires_at' => 'datetime',
        'score' => 'decimal:2',
        'percentage' => 'decimal:2',
        'metadata' => 'array',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($certificate) {
            $certificate->certificate_number = self::generateCertificateNumber();
            $certificate->verification_code = self::generateVerificationCode();
            $certificate->issued_at = now();
            $certificate->status = 'issued';
        });
    }

    /**
     * Get the user that owns the certificate
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the test session that owns the certificate
     */
    public function testSession()
    {
        return $this->belongsTo(TestSession::class);
    }

    /**
     * Generate unique certificate number
     */
    public static function generateCertificateNumber()
    {
        do {
            $number = 'CERT-' . date('Y') . '-' . strtoupper(Str::random(8));
        } while (self::where('certificate_number', $number)->exists());
        
        return $number;
    }

    /**
     * Generate unique verification code
     */
    public static function generateVerificationCode()
    {
        do {
            $code = strtoupper(Str::random(12));
        } while (self::where('verification_code', $code)->exists());
        
        return $code;
    }

    /**
     * Create certificate from test session
     */
    public static function createFromTestSession(TestSession $session)
    {
        // Only create certificate for passed tests
        $maxSkor = $session->total_questions * 5;
        $percentage = $maxSkor > 0 ? ($session->score / $maxSkor) * 100 : 0;
        if ($percentage < 65) {
            return null;
        }

        // Calculate category scores
        $twkScore = 0;
        $tiuScore = 0;
        $tkpScore = 0;
        $twkTotal = 0;
        $tiuTotal = 0;
        $tkpTotal = 0;

        // Get answers data
        if (is_string($session->answers)) {
            $answersData = json_decode($session->answers, true) ?? [];
        } else {
            $answersData = $session->answers ?? [];
        }

        // Handle new format
        if (isset($answersData['question_ids']) && isset($answersData['user_answers'])) {
            $questionIds = $answersData['question_ids'];
            $userAnswers = $answersData['user_answers'];

            $questions = \App\Models\Soal::whereIn('id', $questionIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $questionIds) . ')')
                ->get();

            foreach ($questions as $index => $question) {
                $userAnswer = $userAnswers[$index] ?? null;
                $normalizedUserAnswer = $userAnswer ? strtoupper(trim($userAnswer)) : null;
                $normalizedCorrectAnswer = strtoupper(trim($question->jawaban_benar));

                $isCorrect = $normalizedUserAnswer === $normalizedCorrectAnswer;

                if ($question->kategori === 'TWK') {
                    $twkTotal++;
                    if ($isCorrect) $twkScore++;
                } elseif ($question->kategori === 'TIU') {
                    $tiuTotal++;
                    if ($isCorrect) $tiuScore++;
                } elseif ($question->kategori === 'TKP') {
                    $tkpTotal++;
                    if ($isCorrect) $tkpScore++;
                }
            }
        }

        // Calculate percentages
        $twkPercentage = $twkTotal > 0 ? ($twkScore / $twkTotal) * 100 : 0;
        $tiuPercentage = $tiuTotal > 0 ? ($tiuScore / $tiuTotal) * 100 : 0;
        $tkpPercentage = $tkpTotal > 0 ? ($tkpScore / $tkpTotal) * 100 : 0;

        return self::create([
            'user_id' => $session->user_id,
            'test_session_id' => $session->id,
            'title' => 'Sertifikat Kelulusan Tes CAT CPNS',
            'description' => "Sertifikat ini diberikan kepada peserta yang telah lulus tes {$session->kategori} dengan nilai yang memuaskan.",
            'score' => $session->score,
            'percentage' => $percentage,
            'category' => $session->kategori,
            'total_questions' => $session->total_questions,
            'correct_answers' => $session->score,
            'twk_score' => round($twkPercentage, 2),
            'tiu_score' => round($tiuPercentage, 2),
            'tkp_score' => round($tkpPercentage, 2),
            'expires_at' => now()->addYears(2), // Certificates expire after 2 years
            'metadata' => [
                'test_duration' => $session->finished_at->diffInSeconds($session->started_at),
                'completion_time' => $session->finished_at->format('Y-m-d H:i:s'),
                'difficulty_level' => 'standard',
                'twk_correct' => $twkScore,
                'twk_total' => $twkTotal,
                'tiu_correct' => $tiuScore,
                'tiu_total' => $tiuTotal,
                'tkp_correct' => $tkpScore,
                'tkp_total' => $tkpTotal,
            ],
        ]);
    }

    /**
     * Check if certificate is valid
     */
    public function isValid()
    {
        return $this->status === 'issued' && 
               (!$this->expires_at || $this->expires_at->isFuture());
    }

    /**
     * Get certificate status label
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'issued' => 'Diterbitkan',
            'revoked' => 'Dicabut',
            'expired' => 'Kadaluarsa',
            default => 'Unknown'
        };
    }

    /**
     * Get certificate status color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'issued' => 'success',
            'revoked' => 'danger',
            'expired' => 'warning',
            default => 'secondary'
        };
    }

    /**
     * Revoke certificate
     */
    public function revoke()
    {
        $this->status = 'revoked';
        $this->save();
    }

    /**
     * Verify certificate by code
     */
    public static function verifyByCode($code)
    {
        return self::where('verification_code', $code)->first();
    }

    /**
     * Get certificate URL for public verification
     */
    public function getVerificationUrlAttribute()
    {
        return route('certificates.verify', $this->verification_code);
    }

    /**
     * Get certificate PDF filename
     */
    public function getPdfFilenameAttribute()
    {
        return "certificate_{$this->certificate_number}.pdf";
    }

    /**
     * Scope by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope valid certificates
     */
    public function scopeValid($query)
    {
        return $query->where('status', 'issued')
                    ->where(function ($q) {
                        $q->whereNull('expires_at')
                          ->orWhere('expires_at', '>', now());
                    });
    }

    /**
     * Scope expiring soon (within 30 days)
     */
    public function scopeExpiringSoon($query)
    {
        return $query->where('status', 'issued')
                    ->where('expires_at', '>', now())
                    ->where('expires_at', '<=', now()->addDays(30));
    }
}
