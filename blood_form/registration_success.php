<?php
$registration_number = $_GET['reg_number'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <h2>Registration Successful!</h2>
        <p>Your Unique Registration Number is:</p>
        <h3><?php echo htmlspecialchars($registration_number); ?></h3>
        <p>Please keep this number for future reference.</p>
        <a href="register.php">Back to Registration</a>
    </div>
</body>
</html>