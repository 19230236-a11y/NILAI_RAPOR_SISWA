<?php
$viewPath = 'c:\\Project TA\\NILAI_RAPOR_SISWA\\storage\\framework\\views';

// Get all PHP files in the views directory
$files = glob($viewPath . '\\*.php');

// Delete each file
foreach ($files as $file) {
    if (is_file($file)) {
        unlink($file);
        echo "Deleted: $file\n";
    }
}

echo "All view files cleared!\n";
?>
