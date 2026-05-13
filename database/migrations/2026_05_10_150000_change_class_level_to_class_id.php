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
        Schema::table('students', function (Blueprint $table) {
            // Add new class_id column as unsigned big integer
            if (!Schema::hasColumn('students', 'class_id')) {
                $table->unsignedBigInteger('class_id')->nullable()->after('program_id');
            }
        });

        // Add foreign key constraint
        Schema::table('students', function (Blueprint $table) {
            $table->foreign('class_id')
                ->references('id')
                ->on('classes')
                ->onDelete('set null');
        });

        // Drop old class_level column
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'class_level')) {
                $table->dropColumn('class_level');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop foreign key if exists
            try {
                $table->dropForeignKeyIfExists(['class_id']);
            } catch (\Exception $e) {
                // Ignore if foreign key doesn't exist
            }
            
            // Drop class_id column
            if (Schema::hasColumn('students', 'class_id')) {
                $table->dropColumn('class_id');
            }
            
            // Restore class_level column
            $table->enum('class_level', ['1', '2', '3'])->nullable()->after('address');
        });
    }
};
