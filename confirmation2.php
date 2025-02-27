<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation - Bloodline</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4f4; /* Light background color */
            font-family: Arial, sans-serif;
        }
        .confirmation-section {
            background-color: white; /* White background for the confirmation section */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .form-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d9534f; /* Button color */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .form-btn:hover {
            background-color: #c9302c; /* Darker shade on hover */
        }
        .download-btn {
            background-color: #5bc0de; /* Download button color */
        }
        .download-btn:hover {
            background-color: #31b0d5; /* Darker shade on hover */
        }
    </style>
</head>
<body>
    <div class="confirmation-section">
        <h2>Appointment Confirmed!</h2>
        <p>Thank you for booking your appointment with us. Your invoice number is: <strong><?php echo htmlspecialchars($_GET['invoice_number']); ?></strong></p>
        <p>We will contact you shortly with the details.</p>
        
        <!-- Button to download invoice as PDF -->
        <a href="generate_invoice.php?invoice_number=<?php echo htmlspecialchars($_GET['invoice_number']); ?>" class="form-btn download-btn">Download Invoice PDF</a>
        
        <a href="index.php" class="form-btn">Return to Home<i class='bx bx-right-arrow-alt arrow'></i></a>
    </div>
</body>
</html>