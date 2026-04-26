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
            // Timer management fields
            $table->integer('time_extension')->default(0)->after('finished_at');
            $table->timestamp('last_pause_at')->nullable()->after('time_extension');
            $table->timestamp('last_resume_at')->nullable()->after('last_pause_at');
            $table->integer('total_pause_duration')->default(0)->after('last_resume_at');
            
            // Timer alerts
            $table->boolean('warning_5min_sent')->default(false)->after('total_pause_duration');
            $table->boolean('warning_1min_sent')->default(false)->after('warning_5min_sent');
            $table->boolean('warning_30sec_sent')->default(false)->after('warning_1min_sent');
            
            // Timer settings
            $table->boolean('allow_pause')->default(true)->after('warning_30sec_sent');
            $table->boolean('allow_extension')->default(false)->after('allow_pause');
            $table->integer('max_extensions')->default(0)->after('allow_extension');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('test_sessions', function (Blueprint $table) {
            $table->dropColumn([
                'time_extension',
                'last_pause_at', 
                'last_resume_at',
                'total_pause_duration',
                'warning_5min_sent',
                'warning_1min_sent', 
                'warning_30sec_sent',
                'allow_pause',
                'allow_extension',
                'max_extensions'
            ]);
        });
    }
};
