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
            // Add opsi_e column
            if (!Schema::hasColumn('soals', 'opsi_e')) {
                $table->string('opsi_e')->nullable()->after('opsi_d');
            }

            // Add poin columns for TKP questions
            if (!Schema::hasColumn('soals', 'poin_a')) {
                $table->integer('poin_a')->default(0)->after('pembahasan');
                $table->integer('poin_b')->default(0)->after('poin_a');
                $table->integer('poin_c')->default(0)->after('poin_b');
                $table->integer('poin_d')->default(0)->after('poin_c');
                $table->integer('poin_e')->default(0)->after('poin_d');
            }

            // Modify jawaban_benar to include 'E'
            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D', 'E'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->dropColumn(['opsi_e', 'poin_a', 'poin_b', 'poin_c', 'poin_d', 'poin_e']);
            
            // Revert jawaban_benar to original enum
            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D'])->change();
        });
    }
};
