<?php
session_start();
include("../config.php");

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token is valid
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = :token AND token_expiry > NOW()");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        echo "<script>alert('Invalid or expired token.');</script>";
        exit();
    }

    if (isset($_POST['reset'])) {
        $newPassword = $_POST['new_password'];
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password and clear the token
        $updateStmt = $conn->prepare("UPDATE users SET password = :password, reset_token = NULL, token_expiry = NULL WHERE reset_token = :token");
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':token', $token);
        $updateStmt->execute();

        echo "<script>alert('Password has been reset successfully. You can now log in.');</script>";
        header("Location: index-L&S.php");
        exit();
    }
} else {
    echo "<script>alert('No token provided.');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" ```html
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style-L&S.css">
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form method="POST" action="">
            <div class="input-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            <input type="submit" value="Reset Password" class="btn" name="reset">
        </form>
    </div>
</body>
</html>