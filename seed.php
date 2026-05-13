<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Program;
use App\Models\SchoolClass;

// Create Programs
$programs = [
    [
        'name' => 'Farmasi Klinis & Komunitas',
        'code' => 'FK',
        'description' => 'Program keahlian Farmasi Klinis dan Komunitas',
    ],
    [
        'name' => 'Asisten Keperawatan & Caregiver',
        'code' => 'AK',
        'description' => 'Program keahlian Asisten Keperawatan dan Caregiver',
    ],
    [
        'name' => 'Teknik Komputer & Jaringan',
        'code' => 'TKJ',
        'description' => 'Program keahlian Teknik Komputer dan Jaringan',
    ],
    [
        'name' => 'Teknik Sepeda Motor',
        'code' => 'TSM',
        'description' => 'Program keahlian Teknik Sepeda Motor',
    ],
    [
        'name' => 'Teknik Kendaraan Ringan',
        'code' => 'TKR',
        'description' => 'Program keahlian Teknik Kendaraan Ringan',
    ],
];

echo "Creating programs...\n";
foreach ($programs as $program) {
    Program::firstOrCreate(
        ['code' => $program['code']],
        $program
    );
    echo "✓ {$program['name']}\n";
}

// Create Classes per Program
echo "\nCreating classes...\n";
$programsList = Program::all();
foreach ($programsList as $program) {
    for ($level = 1; $level <= 3; $level++) {
        $className = $program->name . ' ' . $level;
        SchoolClass::firstOrCreate(
            ['name' => $className, 'program_id' => $program->id],
            ['name' => $className, 'program_id' => $program->id]
        );
        echo "✓ {$className}\n";
    }
}

echo "\nSeeding complete!\n";
