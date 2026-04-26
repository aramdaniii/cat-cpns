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
        Schema::table('certificates', function (Blueprint $table) {
            $table->decimal('twk_score', 5, 2)->nullable()->after('correct_answers');
            $table->decimal('tiu_score', 5, 2)->nullable()->after('twk_score');
            $table->decimal('tkp_score', 5, 2)->nullable()->after('tiu_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['twk_score', 'tiu_score', 'tkp_score']);
        });
    }
};
