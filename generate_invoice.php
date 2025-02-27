<?php
require_once 'config.php'; // Include your database connection

if (isset($_GET['invoice_number'])) {
    $invoice_number = $_GET['invoice_number'];

    // Fetch appointment details from the database, joining with the patients table
    $stmt = $conn->prepare("
        SELECT a.*, p.full_name, p.contact_number 
        FROM appointments a 
        JOIN patients p ON a.patient_id = p.id 
        WHERE a.invoice_number = :invoice_number
    ");
    $stmt->bindParam(':invoice_number', $invoice_number);
    $stmt->execute();
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($appointment) {
        // Start outputting the HTML
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invoice - Bloodline</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .invoice-container {
                    background-color: white;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    max-width: 600px;
                    margin: auto;
                }
                .header {
                    text-align: center;
                }
                .header img {
                    width: 100px; /* Adjust logo size */
                }
                .header h1 {
                    margin: 10px 0;
                }
                .details {
                    margin: 20px 0;
                }
                .details p {
                    margin: 5px 0;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                }
                .print-btn, .home-btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #d9534f; /* Button color */
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 20px;
                }
                .print-btn:hover, .home-btn:hover {
                    background-color: #c9302c; /* Darker shade on hover */
                }
                .home-btn {
                    background-color: #5bc0de; /* Different color for home button */
                }
                .home-btn:hover {
                    background-color: #31b0d5; /* Darker shade on hover */
                }
            </style>
        </head>
        <body>
            <div class="invoice-container">
                <div class="header">
                    <img src="images/logo.jpg" alt="Bloodline Logo">
                    <h1>Bloodline Appointment Invoice</h1>
                </div>
                <div class="details">
                    <p><strong>Invoice Number:</strong> <?php echo htmlspecialchars($invoice_number); ?></p>
                    <p><strong>Doctor:</strong> <?php echo htmlspecialchars($appointment['doctor']); ?></p>
                    <p><strong>Appointment Date:</strong> <?php echo htmlspecialchars($appointment['appointment_date']); ?></p>
                    <p><strong>Appointment Time:</strong> <?php echo htmlspecialchars($appointment['appointment_time']); ?></p>
                    <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($appointment['full_name']); ?></p>
                    <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($appointment['contact_number']); ?></p>
                    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($appointment['payment_method']); ?></p>
                    <p><strong>Additional Message:</strong> <?php echo htmlspecialchars($appointment['message']); ?></p>
                </div>
                <div class="footer">
                    <p>Thank you for choosing Bloodline!</p>
                    <a href="javascript:window.print();" class="print-btn">Print Invoice</a>
                    <a href="index.php" class="home-btn">Go to Home Page</a> <!-- Home Page Button -->
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Invoice not found.";
    }
} else {
    echo "No invoice number provided.";
}
?>