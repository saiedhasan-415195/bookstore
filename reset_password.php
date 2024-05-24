

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="container">
        <form action="reset_password.php" method="post">
            <fieldset>
                <h2>Change Password</h2>
                <p>Please enter your username and new password to change your password.</p>
                <hr>
                <div class="mid">
                    <label for="username"><b>Username</b></label><br>
                    <input type="text" placeholder="Enter Username" name="username" id="username" required><br><br>
                    <label for="new_password"><b>New Password</b></label><br>
                    <input type="password" placeholder="Enter New Password" name="new_password" id="new_password" required><br><br>
                    <label for="confirm_password"><b>Confirm New Password</b></label><br>
                    <input type="password" placeholder="Confirm New Password" name="confirm_password" id="confirm_password" required><br><br>
                </div>
                <hr>
                <div class="btn-div">
                    <button type="submit" name="submit" class="reset-button">Change Password</button>
                    
                </div>
                <div class="btn-div">
                <a href="login.php">Login</a>
                </div>
            </fieldset>
        </form>
    </div>

</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required keys exist in the $_POST array
    if (isset($_POST['username'], $_POST['new_password'], $_POST['confirm_password'])) {
        $username = $_POST['username'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Validate input
        if (empty($username) || empty($new_password) || empty($confirm_password)) {
            echo "All fields are required.";
            exit();
        }

        if ($new_password !== $confirm_password) {
            echo "New password and confirmation do not match.";
            exit();
        }

        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'bookstore');

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the password
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Password changed successfully
            echo "<script>alert('Your password has been successfully changed.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            // Username not found or password could not be changed
            echo "Username not found or password could not be changed.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>
