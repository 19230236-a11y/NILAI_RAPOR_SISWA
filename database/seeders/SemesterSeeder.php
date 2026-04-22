<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [
            'Semester 1',
            'Semester 2',
        ];
        
        foreach ($semesters as $semester) {
            Semester::create(['name' => $semester]);
        }
    }
}
