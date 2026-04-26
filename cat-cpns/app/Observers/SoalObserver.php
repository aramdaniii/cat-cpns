<?php

namespace App\Observers;

use App\Models\Soal;
use Illuminate\Support\Facades\Cache;

class SoalObserver
{
    /**
     * Handle the Soal "created" event.
     */
    public function created(Soal $soal): void
    {
        $this->clearSoalCache();
    }

    /**
     * Handle the Soal "updated" event.
     */
    public function updated(Soal $soal): void
    {
        $this->clearSoalCache();
    }

    /**
     * Handle the Soal "deleted" event.
     */
    public function deleted(Soal $soal): void
    {
        $this->clearSoalCache();
    }

    /**
     * Clear soal-related cache
     */
    private function clearSoalCache(): void
    {
        Cache::forget('soal_kategori_options');
        Cache::forget('soal_difficulty_options');
        Cache::forget('soal_count_by_category');
        Cache::forget('soal_count_by_difficulty');
        
        // Clear analytics cache
        Cache::forget('analytics_overview');
        Cache::forget('analytics_test_stats');
    }
}
