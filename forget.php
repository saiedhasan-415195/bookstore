<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="container">
        <form action="reset_password.php" method="post">
            <fieldset>
                <h2>Forgot Password</h2>
                <p>Please enter your email address to reset your password.</p>
                <hr>
                <div class="mid">
                    <label for="email"><b>Email</b></label><br>
                    <input type="email" placeholder="Enter Email" name="email" id="email" required><br><br>
                </div>
                <hr>
                <div class="btn-div">
                    <button type="submit" name="submit" class="reset-button">Send Reset Link</button>
                    <br><br>
                    <p>Remember your password? <a href="login.php">Login</a>.</p>
                </div>
            </fieldset>
        </form>
    </div>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'bookstore');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if email exists in the database
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Email found in the database, redirect to reset password page
            header("Location: reset_password.php?email=" . urlencode($email));
            exit();
        } else {
            // No user found with that email address, show an alert and stay on the same page
            echo "<script>alert('No user found with that email address.');</script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        // Invalid email format, show an alert and stay on the same page
        echo "<script>alert('Invalid email format.');</script>";
    }
}
?>
