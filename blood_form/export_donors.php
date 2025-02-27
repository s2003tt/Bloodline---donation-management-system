<?php
require_once '../config.php';

// Fetch all donors
$stmt = $pdo->query("SELECT * FROM donors");
$donors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="donors_list.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Write column headers
fputcsv($output, ['Reg. Number', 'Name', 'Blood Group', 'Gender', 'Date of Birth', 'City', 'Province', 'Email', 'Contact Number']);

// Write donor data
foreach ($donors as $donor) {
    fputcsv($output, [
        $donor['unique_registration_number'],
        $donor['full_name'],
        $donor['blood_group'],
        $donor['gender'],
        $donor['date_of_birth'],
        $donor['city'],
        $donor['province'],
        $donor['email'],
        $donor['contact_number']
    ]);
}

// Close output stream
fclose($output);
exit();