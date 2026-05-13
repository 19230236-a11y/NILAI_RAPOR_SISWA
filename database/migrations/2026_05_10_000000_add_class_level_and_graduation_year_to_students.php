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
            if (!Schema::hasColumn('students', 'class_level')) {
                $table->enum('class_level', ['1', '2', '3'])->nullable()->after('address');
            }
            if (!Schema::hasColumn('students', 'graduation_year')) {
                $table->year('graduation_year')->nullable()->after('class_level');
            }
            if (!Schema::hasColumn('students', 'birth_place')) {
                $table->string('birth_place')->nullable()->after('birth_date');
            }
            if (!Schema::hasColumn('students', 'program_id')) {
                $table->foreignId('program_id')->nullable()->constrained('programs')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop foreign key first before dropping the column
            try {
                $table->dropForeignKeyIfExists(['program_id']);
            } catch (\Exception $e) {
                // Ignore if foreign key doesn't exist
            }
            
            // Now drop columns
            $columnsToDelete = [];
            if (Schema::hasColumn('students', 'class_level')) {
                $columnsToDelete[] = 'class_level';
            }
            if (Schema::hasColumn('students', 'graduation_year')) {
                $columnsToDelete[] = 'graduation_year';
            }
            if (Schema::hasColumn('students', 'birth_place')) {
                $columnsToDelete[] = 'birth_place';
            }
            if (Schema::hasColumn('students', 'program_id')) {
                $columnsToDelete[] = 'program_id';
            }
            
            if (!empty($columnsToDelete)) {
                $table->dropColumn($columnsToDelete);
            }
        });
    }
};
