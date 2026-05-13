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
            // Nama mata pelajaran jurusan (input manual)
            $table->string('jurusan_subject_1')->nullable()->after('nilai');
            $table->string('jurusan_subject_2')->nullable()->after('jurusan_subject_1');
            $table->string('jurusan_subject_3')->nullable()->after('jurusan_subject_2');
            $table->string('jurusan_subject_4')->nullable()->after('jurusan_subject_3');
            $table->string('jurusan_subject_5')->nullable()->after('jurusan_subject_4');
            $table->string('jurusan_subject_6')->nullable()->after('jurusan_subject_5');

            // Nilai mata pelajaran jurusan
            $table->decimal('jurusan_nilai_1', 5, 2)->nullable()->after('jurusan_subject_6');
            $table->decimal('jurusan_nilai_2', 5, 2)->nullable()->after('jurusan_nilai_1');
            $table->decimal('jurusan_nilai_3', 5, 2)->nullable()->after('jurusan_nilai_2');
            $table->decimal('jurusan_nilai_4', 5, 2)->nullable()->after('jurusan_nilai_3');
            $table->decimal('jurusan_nilai_5', 5, 2)->nullable()->after('jurusan_nilai_4');
            $table->decimal('jurusan_nilai_6', 5, 2)->nullable()->after('jurusan_nilai_5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropColumn([
                'jurusan_subject_1', 'jurusan_subject_2', 'jurusan_subject_3',
                'jurusan_subject_4', 'jurusan_subject_5', 'jurusan_subject_6',
                'jurusan_nilai_1', 'jurusan_nilai_2', 'jurusan_nilai_3',
                'jurusan_nilai_4', 'jurusan_nilai_5', 'jurusan_nilai_6'
            ]);
        });
    }
};
