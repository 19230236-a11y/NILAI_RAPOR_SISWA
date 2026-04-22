<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'nis' => '12345',
            'name' => 'Ahmad Fauzi',
            'gender' => 'L',
            'birth_date' => '2005-05-15',
            'address' => 'Jl. Sudirman No. 10, Jakarta',
        ]);

        Student::create([
            'nis' => '12346',
            'name' => 'Siti Aminah',
            'gender' => 'P',
            'birth_date' => '2005-08-20',
            'address' => 'Jl. Thamrin No. 5, Bandung',
        ]);
    }
}
