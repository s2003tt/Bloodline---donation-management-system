<?php
session_start();
include("../config.php");

if (isset($_POST['recover'])) {
    $email = $_POST['email'];

    // Check if the email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token valid for 1 hour

        // Store the token in the database
        $updateStmt = $conn->prepare("UPDATE users SET reset_token = :token, token_expiry = :expiry WHERE email = :email");
        $updateStmt->bindParam(':token', $token);
        $updateStmt->bindParam(':expiry', $expiry);
        $updateStmt->bindParam(':email', $email);
        $updateStmt->execute();

        // Send the password reset email
        $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n" . $resetLink;
        mail($email, $subject, $message); // Use a proper mail function in production

        echo "<script>alert('Password reset link has been sent to your email.');</script>";
    } else {
        echo "<script>alert('Email not found.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="style-L&S.css">
</head>
<body>
    <div class="container">
        <h1>Recover Password</h1>
        <form method="POST" action="">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <input type="submit" value="Send Recovery Email" class="btn" name="recover">
        </form>
    </div>
</body>
</html>