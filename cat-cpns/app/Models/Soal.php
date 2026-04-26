<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'opsi_e',
        'jawaban_benar',
        'pembahasan',
        'kategori',
        'difficulty',
        'difficulty_level',
        'discrimination_index',
        'difficulty_index',
        'attempts_count',
        'correct_count',
        'last_attempted_at',
        'performance_history',
        'poin_a',
        'poin_b',
        'poin_c',
        'poin_d',
        'poin_e',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_attempted_at' => 'datetime',
        'performance_history' => 'array',
        'discrimination_index' => 'decimal:3',
        'difficulty_index' => 'decimal:3',
    ];

    /**
     * Get the category options (cached)
     */
    public static function getKategoriOptions()
    {
        return cache()->remember('soal_kategori_options', 3600, function () {
            return [
                'TWK' => 'Tes Wawasan Kebangsaan',
                'TIU' => 'Tes Intelegensi Umum',
                'TKP' => 'Tes Karakteristik Pribadi',
            ];
        });
    }

    /**
     * Get category label
     */
    public function getKategoriLabelAttribute()
    {
        $options = self::getKategoriOptions();
        return $options[$this->kategori] ?? $this->kategori;
    }

    /**
     * Get category color for badges
     */
    public function getKategoriColorAttribute()
    {
        return match($this->kategori) {
            'TWK' => 'primary',
            'TIU' => 'warning',
            'TKP' => 'info',
            default => 'secondary'
        };
    }

    /**
     * Scope by category
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Get difficulty options (cached)
     */
    public static function getDifficultyOptions()
    {
        return cache()->remember('soal_difficulty_options', 3600, function () {
            return [
                'mudah' => 'Mudah',
                'sedang' => 'Sedang',
                'sulit' => 'Sulit',
            ];
        });
    }

    /**
     * Get difficulty label
     */
    public function getDifficultyLabelAttribute()
    {
        $options = self::getDifficultyOptions();
        return $options[$this->difficulty] ?? $this->difficulty;
    }

    /**
     * Get difficulty color for badges
     */
    public function getDifficultyColorAttribute()
    {
        return match($this->difficulty) {
            'mudah' => 'success',
            'sedang' => 'warning',
            'sulit' => 'danger',
            default => 'secondary'
        };
    }

    /**
     * Scope by difficulty
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /**
     * Record answer attempt for adaptive testing
     */
    public function recordAttempt($isCorrect)
    {
        $this->attempts_count++;
        if ($isCorrect) {
            $this->correct_count++;
        }
        
        // Update performance history
        $history = $this->performance_history ?? [];
        $history[] = [
            'attempted_at' => now()->toISOString(),
            'is_correct' => $isCorrect,
            'running_accuracy' => $this->correct_count / $this->attempts_count
        ];
        $this->performance_history = $history;
        
        // Update last attempted timestamp
        $this->last_attempted_at = now();
        
        // Calculate difficulty index if we have enough data
        if ($this->attempts_count >= 10) {
            $this->calculateDifficultyIndex();
        }
        
        $this->save();
    }

    /**
     * Calculate difficulty index based on performance
     */
    private function calculateDifficultyIndex()
    {
        $accuracy = $this->correct_count / $this->attempts_count;
        
        // Difficulty index: 0.0 (easiest) to 1.0 (hardest)
        // Higher accuracy = easier question (lower index)
        $this->difficulty_index = 1.0 - $accuracy;
        
        // Calculate discrimination index (simplified)
        // This would normally need more complex analysis
        $this->discrimination_index = $this->calculateDiscriminationIndex();
    }

    /**
     * Calculate discrimination index (simplified version)
     */
    private function calculateDiscriminationIndex()
    {
        // Simplified discrimination calculation
        // In a real system, this would compare top vs bottom performers
        $recentHistory = array_slice($this->performance_history ?? [], -20);
        if (count($recentHistory) < 10) {
            return null;
        }
        
        $correctCount = array_sum(array_column($recentHistory, 'is_correct'));
        $totalAttempts = count($recentHistory);
        
        // Basic discrimination: how well the question differentiates
        $accuracy = $correctCount / $totalAttempts;
        
        // Questions with 30-70% accuracy typically have good discrimination
        if ($accuracy >= 0.3 && $accuracy <= 0.7) {
            return 0.5 + (0.5 - abs($accuracy - 0.5)); // Peak at 50% accuracy
        } else {
            return max(0.1, 0.5 - abs($accuracy - 0.5)); // Lower discrimination
        }
    }

    /**
     * Get adaptive difficulty score
     */
    public function getAdaptiveScore()
    {
        $baseScore = match($this->difficulty) {
            'mudah' => 1,
            'sedang' => 2,
            'sulit' => 3,
            default => 2
        };
        
        // Adjust based on calculated difficulty index if available
        if ($this->difficulty_index !== null) {
            $baseScore += (1.0 - $this->difficulty_index) * 2;
        }
        
        return round($baseScore, 2);
    }

    /**
     * Check if question is suitable for adaptive testing
     */
    public function isSuitableForAdaptive()
    {
        return $this->attempts_count >= 10 && 
               $this->difficulty_index !== null && 
               $this->discrimination_index !== null &&
               $this->discrimination_index > 0.2;
    }

    /**
     * Get all options as array
     */
    public function getOptionsAttribute()
    {
        return [
            'A' => $this->opsi_a,
            'B' => $this->opsi_b,
            'C' => $this->opsi_c,
            'D' => $this->opsi_d,
        ];
    }
}
