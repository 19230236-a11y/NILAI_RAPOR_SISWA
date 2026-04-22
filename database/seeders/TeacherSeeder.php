<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get subjects first
        $subjects = Subject::all();
        
        if ($subjects->isEmpty()) {
            // If no subjects, create some
            $subjectNames = ['Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi'];
            foreach ($subjectNames as $name) {
                $subjects->push(Subject::create(['name' => $name]));
            }
        }
        
        $teacherData = [
            ['nip' => 'NIP001', 'name' => 'Budi Santoso', 'subject_id' => $subjects->first()->id ?? 1],
            ['nip' => 'NIP002', 'name' => 'Siti Nurhaliza', 'subject_id' => $subjects->get(1)->id ?? 2],
            ['nip' => 'NIP003', 'name' => 'Ahmad Wijaya', 'subject_id' => $subjects->get(2)->id ?? 3],
            ['nip' => 'NIP004', 'name' => 'Dewi Kusuma', 'subject_id' => $subjects->get(3)->id ?? 4],
            ['nip' => 'NIP005', 'name' => 'Eka Pratama', 'subject_id' => $subjects->get(4)->id ?? 5],
        ];
        
        foreach ($teacherData as $data) {
            Teacher::create($data);
        }
    }
}
