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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('test_session_id')->constrained()->onDelete('cascade');
            $table->string('certificate_number')->unique();
            $table->string('title');
            $table->text('description');
            $table->decimal('score', 5, 2);
            $table->decimal('percentage', 5, 2);
            $table->string('category');
            $table->integer('total_questions');
            $table->integer('correct_answers');
            $table->timestamp('issued_at');
            $table->timestamp('expires_at')->nullable();
            $table->string('status')->default('issued'); // issued, revoked, expired
            $table->string('verification_code')->unique();
            $table->json('metadata')->nullable(); // Additional certificate data
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['verification_code']);
            $table->index(['certificate_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
