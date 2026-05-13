<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kepala Sekolah
        User::updateOrCreate(
            ['email' => 'kepsek@rapor.sch.id'],
            [
                'name' => 'Kepala Sekolah',
                'password' => Hash::make('kepsek123'),
                'role' => User::ROLE_KEPALA_SEKOLAH,
                'position' => 'Kepala Sekolah',
                'department' => 'Kepala Sekolah',
                'email_verified_at' => now(),
            ]
        );

        // Staff TU contoh yang bisa digunakan untuk login
        User::updateOrCreate(
            ['email' => 'stafftu1@rapor.sch.id'],
            [
                'name' => 'Staff TU 1',
                'password' => Hash::make('stafftu123'),
                'role' => User::ROLE_STAFF_TU,
                'position' => 'Staff TU',
                'department' => 'Tata Usaha',
                'email_verified_at' => now(),
            ]
        );

        // Staff TU contoh kedua
        User::updateOrCreate(
            ['email' => 'stafftu2@rapor.sch.id'],
            [
                'name' => 'Staff TU 2',
                'password' => Hash::make('stafftu123'),
                'role' => User::ROLE_STAFF_TU,
                'position' => 'Staff TU',
                'department' => 'Tata Usaha',
                'email_verified_at' => now(),
            ]
        );
    }
}