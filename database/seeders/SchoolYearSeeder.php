<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = [
            '2023/2024',
            '2024/2025',
            '2025/2026',
        ];
        
        foreach ($years as $year) {
            SchoolYear::create(['year' => $year]);
        }
    }
}
