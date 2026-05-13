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
        // Generate school years from 2010/2011 to 2040/2041 (30 years range)
        $years = [];
        $startYear = 2010;
        $endYear = 2040;
        
        for ($i = $startYear; $i < $endYear; $i++) {
            $years[] = $i . '/' . ($i + 1);
        }
        
        foreach ($years as $year) {
            SchoolYear::firstOrCreate(['year' => $year]);
        }
    }
}
