<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            // Index on difficulty_level for filtering by difficulty
            $table->index('difficulty_level', 'idx_soals_difficulty_level');
            
            // Composite index for category + difficulty filtering
            $table->index(['kategori', 'difficulty_level'], 'idx_soals_kategori_difficulty');
            
            // Index on created_at for sorting in admin panel
            $table->index('created_at', 'idx_soals_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropIndex('idx_soals_difficulty_level');
            $table->dropIndex('idx_soals_kategori_difficulty');
            $table->dropIndex('idx_soals_created_at');
        });
    }
};
