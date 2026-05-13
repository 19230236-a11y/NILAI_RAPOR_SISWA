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
        Schema::table('grades', function (Blueprint $table) {
            // Drop the old columns
            $table->dropColumn(['nilai_tugas', 'nilai_uts', 'nilai_uas', 'nilai_akhir']);
            
            // Add new single value column
            $table->decimal('nilai', 5, 2)->after('semester_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            // Restore old columns
            $table->dropColumn('nilai');
            $table->decimal('nilai_tugas', 5, 2);
            $table->decimal('nilai_uts', 5, 2);
            $table->decimal('nilai_uas', 5, 2);
            $table->decimal('nilai_akhir', 5, 2)->nullable();
        });
    }
};
