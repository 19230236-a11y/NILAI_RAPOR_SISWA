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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Farmasi Klinis & Komunitas, dll
            $table->string('code')->unique(); // FK, AK, TKJ, TSM, TKR
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add program_id to students table
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('program_id')->nullable()->constrained('programs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['program_id']);
            $table->dropColumn('program_id');
        });

        Schema::dropIfExists('programs');
    }
};
