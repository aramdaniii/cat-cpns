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
            // Difficulty levels
            $table->enum('difficulty', ['mudah', 'sedang', 'sulit'])->default('sedang')->after('kategori');
            
            // Adaptive testing fields
            $table->decimal('discrimination_index', 5, 3)->nullable()->after('difficulty');
            $table->decimal('difficulty_index', 5, 3)->nullable()->after('discrimination_index');
            $table->integer('attempts_count')->default(0)->after('difficulty_index');
            $table->integer('correct_count')->default(0)->after('attempts_count');
            
            // Performance tracking
            $table->timestamp('last_attempted_at')->nullable()->after('correct_count');
            $table->json('performance_history')->nullable()->after('last_attempted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropColumn([
                'difficulty',
                'discrimination_index',
                'difficulty_index',
                'attempts_count',
                'correct_count',
                'last_attempted_at',
                'performance_history'
            ]);
        });
    }
};
