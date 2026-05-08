<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'name' => 'Farmasi Klinis & Komunitas',
                'code' => 'FK',
                'description' => 'Program keahlian Farmasi Klinis dan Komunitas',
            ],
            [
                'name' => 'Asisten Keperawatan & Caregiver',
                'code' => 'AK',
                'description' => 'Program keahlian Asisten Keperawatan dan Caregiver',
            ],
            [
                'name' => 'Teknik Komputer & Jaringan',
                'code' => 'TKJ',
                'description' => 'Program keahlian Teknik Komputer dan Jaringan',
            ],
            [
                'name' => 'Teknik Sepeda Motor',
                'code' => 'TSM',
                'description' => 'Program keahlian Teknik Sepeda Motor',
            ],
            [
                'name' => 'Teknik Kendaraan Ringan',
                'code' => 'TKR',
                'description' => 'Program keahlian Teknik Kendaraan Ringan',
            ],
        ];

        foreach ($programs as $program) {
            Program::firstOrCreate(
                ['code' => $program['code']],
                $program
            );
        }
    }
}
