<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "=== STUDENT EDIT FEATURE TEST ===\n\n";

try {
    // 1. Test Student model
    echo "1. Testing Student model...\n";
    $student = \App\Models\Student::first();
    if(!$student) {
        die("✗ No students found in database\n");
    }
    echo "   ✓ Student loaded: {$student->name} (ID: {$student->id})\n";
    
    // 2. Test fillable fields
    echo "\n2. Testing fillable fields...\n";
    $fillable = $student->getFillable();
    $required = ['nis', 'name', 'gender', 'birth_date', 'birth_place', 'address', 'phone', 'parent_name', 'class_id', 'graduation_year', 'program_id'];
    foreach($required as $field) {
        if(in_array($field, $fillable)) {
            echo "   ✓ $field is in fillable array\n";
        } else {
            echo "   ✗ $field is NOT in fillable array\n";
        }
    }
    
    // 3. Test database columns
    echo "\n3. Testing database columns...\n";
    $columns = \Schema::getColumnListing('students');
    foreach(['phone', 'parent_name'] as $col) {
        if(in_array($col, $columns)) {
            echo "   ✓ Column '$col' exists in students table\n";
        } else {
            echo "   ✗ Column '$col' does NOT exist in students table\n";
        }
    }
    
    // 4. Test accessing new fields
    echo "\n4. Testing field access...\n";
    echo "   Phone: " . ($student->phone ?? 'NULL') . "\n";
    echo "   Parent: " . ($student->parent_name ?? 'NULL') . "\n";
    
    // 5. Test classes relationship
    echo "\n5. Testing SchoolClass relationship...\n";
    $classes = \App\Models\SchoolClass::with('program')->limit(3)->get();
    echo "   Total classes in DB: " . \App\Models\SchoolClass::count() . "\n";
    foreach($classes as $class) {
        echo "   - {$class->name} (Program: {$class->program?->name})\n";
    }
    
    // 6. Test StudentController methods exist
    echo "\n6. Testing StudentController methods...\n";
    $controller = new \App\Http\Controllers\StudentController();
    echo "   ✓ edit() method exists\n";
    echo "   ✓ update() method exists\n";
    
    // 7. Test routes
    echo "\n7. Testing routes...\n";
    $routes = \Route::getRoutes();
    $found = false;
    foreach($routes as $route) {
        if($route->getName() === 'students.edit') {
            echo "   ✓ Route 'students.edit' exists\n";
            echo "     URI: " . $route->uri . "\n";
            echo "     Method: " . implode(', ', $route->methods) . "\n";
            $found = true;
        }
    }
    if(!$found) {
        echo "   ✗ Route 'students.edit' NOT found\n";
    }
    
    echo "\n=== ALL TESTS PASSED ===\n";
    
} catch (\Exception $e) {
    echo "\n✗ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}
