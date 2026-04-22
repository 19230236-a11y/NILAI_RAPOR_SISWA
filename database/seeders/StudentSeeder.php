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
        $students = [
            ['nis' => '12345', 'name' => 'Ahmad Fauzi', 'gender' => 'L', 'birth_date' => '2005-05-15', 'address' => 'Jl. Sudirman No. 10, Jakarta'],
            ['nis' => '12346', 'name' => 'Siti Aminah', 'gender' => 'P', 'birth_date' => '2005-08-20', 'address' => 'Jl. Thamrin No. 5, Bandung'],
            ['nis' => '12347', 'name' => 'Rudi Hermawan', 'gender' => 'L', 'birth_date' => '2005-03-10', 'address' => 'Jl. Gatot Subroto No. 15, Surabaya'],
            ['nis' => '12348', 'name' => 'Maya Putri', 'gender' => 'P', 'birth_date' => '2006-01-25', 'address' => 'Jl. Diponegoro No. 8, Medan'],
            ['nis' => '12349', 'name' => 'Bambang Irawan', 'gender' => 'L', 'birth_date' => '2005-06-30', 'address' => 'Jl. Ahmad Yani No. 20, Yogyakarta'],
            ['nis' => '12350', 'name' => 'Lidia Sari', 'gender' => 'P', 'birth_date' => '2005-11-12', 'address' => 'Jl. Basuki Rahmat No. 12, Semarang'],
            ['nis' => '12351', 'name' => 'Doni Setiyawan', 'gender' => 'L', 'birth_date' => '2006-02-18', 'address' => 'Jl. Imam Bonjol No. 25, Malang'],
            ['nis' => '12352', 'name' => 'Rina Sulistyo', 'gender' => 'P', 'birth_date' => '2005-07-08', 'address' => 'Jl. Merdeka No. 30, Bali'],
        ];
        
        foreach ($students as $student) {
            Student::create($student);
        }
    }
}

