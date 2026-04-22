<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            'Kelas 10 IPA',
            'Kelas 10 IPS',
            'Kelas 11 IPA',
            'Kelas 11 IPS',
            'Kelas 12 IPA',
            'Kelas 12 IPS',
        ];
        
        foreach ($classes as $class) {
            SchoolClass::create(['name' => $class]);
        }
    }
}
