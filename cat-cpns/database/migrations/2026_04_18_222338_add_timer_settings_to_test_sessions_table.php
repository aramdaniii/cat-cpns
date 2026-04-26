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
        Schema::table('test_sessions', function (Blueprint $table) {
            $table->integer('time_per_question')->default(60)->after('total_questions'); // detik per soal
            $table->timestamp('question_started_at')->nullable()->after('started_at'); // waktu mulai soal
            $table->integer('time_remaining')->nullable()->after('question_started_at'); // sisa waktu
            $table->boolean('timer_enabled')->default(true)->after('time_remaining'); // apakah timer diaktifkan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_sessions', function (Blueprint $table) {
            $table->dropColumn([
                'time_per_question',
                'question_started_at',
                'time_remaining',
                'timer_enabled'
            ]);
        });
    }
};
