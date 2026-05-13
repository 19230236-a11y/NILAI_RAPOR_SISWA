<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use App\Models\Program;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all programs
        $programs = Program::all();
        
        // Class levels with their numeric representation
        $levels = [
            'X' => 10,
            'XI' => 11,
            'XII' => 12,
        ];
        
        $classCodes = [1, 2, 3];
        
        // For each program, create classes for each level and code
        // e.g., X Farmasi 1, X Farmasi 2, X Farmasi 3, XI Farmasi 1, etc.
        foreach ($programs as $program) {
            foreach ($levels as $level => $levelNum) {
                foreach ($classCodes as $code) {
                    $className = $level . ' ' . $program->name . ' ' . $code;
                    SchoolClass::firstOrCreate(
                        ['name' => $className, 'program_id' => $program->id, 'level' => $level, 'class_code' => $code],
                        ['name' => $className, 'program_id' => $program->id, 'level' => $level, 'class_code' => $code]
                    );
                }
            }
        }
    }
}
