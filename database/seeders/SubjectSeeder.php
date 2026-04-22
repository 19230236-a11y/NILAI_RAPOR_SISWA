<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create(['name' => 'Matematika']);
        Subject::create(['name' => 'Bahasa Indonesia']);
        Subject::create(['name' => 'Bahasa Inggris']);
        Subject::create(['name' => 'Fisika']);
        Subject::create(['name' => 'Kimia']);
        Subject::create(['name' => 'Biologi']);
    }
}
