<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            ['name' => 'Ibu Siti', 'nip' => '19800101200001'],
            ['name' => 'Bapak Ahmad', 'nip' => '19850203200002'],
            ['name' => 'Ibu Dewi', 'nip' => '19900504200003'],
            ['name' => 'Bapak Rudi', 'nip' => '19950605200004'],
            ['name' => 'Ibu Ani', 'nip' => '19880706200005'],
        ];

        foreach ($teachers as $teacher) {
            Teacher::firstOrCreate(
                ['nip' => $teacher['nip']],
                ['name' => $teacher['name']]
            );
        }
    }
}
