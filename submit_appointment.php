<?php
require_once 'config.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);
    $doctor = htmlspecialchars($_POST['doctor']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $message = htmlspecialchars($_POST['message']);
    $payment = htmlspecialchars($_POST['payment']);

    try {
        // Insert patient information
        $stmt = $conn->prepare("INSERT INTO patients (full_name, contact_number, email) VALUES (?, ?, ?)");
        $stmt->execute([$name, $contact, $email]);
        $patient_id = $conn->lastInsertId(); // Get the last inserted patient ID

        // Generate a unique invoice number
        $invoice_number = 'INV-' . strtoupper(uniqid());

        // Insert appointment details
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor, appointment_date, appointment_time, message, payment_method, invoice_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$patient_id, $doctor, $date, $time, $message, $payment, $invoice_number]);

        // Redirect to confirmation page with invoice number
        header("Location: confirmation2.php?invoice_number=$invoice_number");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>