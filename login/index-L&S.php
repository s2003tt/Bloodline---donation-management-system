<?php
session_start();
include("../config.php"); // Ensure this file establishes the $conn variable

// Handle Sign Up
if (isset($_POST['signUp'])) {
    try {
        // Get form data
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $checkEmailStmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $checkEmailStmt->bindParam(':email', $email);
        $checkEmailStmt->execute();

        if ($checkEmailStmt->rowCount() > 0) {
            echo "<script>alert('Email Address Already Exists!');</script>";
        } else {
            // Insert new user into database
            $insertQuery = "INSERT INTO users (firstName, lastName, email, password) VALUES (:firstName, :lastName, :email, :password)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bindParam(':firstName', $firstName);
            $insertStmt->bindParam(':lastName', $lastName);
            $insertStmt->bindParam(':email', $email);
            $insertStmt->bindParam(':password', $hashedPassword);

            if ($insertStmt->execute()) {
                header("Location: index-L&S.php");
                exit();
            } else {
                echo "<script>alert('Error: Could not register user');</script>";
            }
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}

// Handle Sign In
if (isset($_POST['signIn'])) {
    try {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare SQL statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Verify the password
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $row['email'];
                header("Location: ../index.php"); // Redirect to home page
                exit();
            } else {
                echo "<script>alert('Incorrect Password');</script>";
            }
        } else {
            echo "<script>alert('Email Not Found');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index-L&S.php"); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodLine</title>
    <link rel="stylesheet" href="style-L&S.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="../login-img/logo.jpg" alt="Bloodline Logo">
        </div>
        <div class="nav-head">
            <p>~ Find blood donors quickly and easily ~</p>
        </div>
    </nav>
    <div class="siteHead">
        <h1>Blood<span>L</span>ine</h1>
    </div>
    <div class="container" id="signUp" style="display:none;">
        <h1 class="form-title">Register</h1>

        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="First Name" required>
                <label for="fName">First Name</label>
            </div>

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                <label for="lName">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <input type="submit" value="Sign Up" class="btn" name="signUp">
        </form>

        <p class="or">~~~~~~~~~~or~~~~~~~~~~</p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
            <p>Already Have Account?</p>
            <button id="signInButton">Sign In </button>
        </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>

        <form method="POST" action="">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <p class="recover">
                <a href="recover_password.php">Recover Password</a>
            </p>
            <input type="submit" value="Sign In" class="btn" name="signIn">
        </form>

        <p class="or">~~~~~~~~~~or~~~~~~~~~~ </p>
        <div class="icons">
            <i class="fab fa-google"></i>
            <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
            <p>Don't have account yet?</p>
            <button id="signUpButton">Sign Up </button>
        </div>
    </div>

    <div class="logout">
        <?php if (isset($_SESSION['email'])): ?>
            <a href="?logout=true" class="btn">Logout</a>
        <?php endif; ?>
    </div>

    <script src="script_LS.js"></script>

</body>
</html>