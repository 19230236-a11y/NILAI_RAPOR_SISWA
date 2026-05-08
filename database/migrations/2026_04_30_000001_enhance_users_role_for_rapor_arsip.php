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
        Schema::table('users', function (Blueprint $table) {
            // Update role column to allow specific roles
            $table->enum('role', ['admin', 'kepala_sekolah', 'staff_tu', 'staff_kurikulum', 'guru', 'siswa', 'user'])
                  ->default('user')
                  ->change();
            
            // Add additional fields for staff
            $table->string('nip')->nullable()->after('role');
            $table->text('alamat')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nip');
            $table->dropColumn('alamat');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('jenis_kelamin');
            
            // Revert role back to string
            $table->string('role')->default('user')->change();
        });
    }
};