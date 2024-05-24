<?php
include 'connect.php';
include 'header.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('Location: login.php');
    exit;
}

// Fetch user data from the 'users' table
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();

// Update user profile
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify old password
    if ($old_password === $userData['password']) {
        // Check if the new password and confirm password match
        if ($new_password === $confirm_password) {
            // Update user details in the 'users' table
            $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $email, $new_password, $user_id);
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->affected_rows > 0) {
                echo "<script> alert('Profile updated successfully'); </script>";
            } else {
                echo "<script> alert('Profile update failed'); </script>";
            }

            $stmt->close();
        } else {
            echo "<script> alert('New password and confirm password do not match'); </script>";
        }
    } else {
        echo "<script> alert('Old password is incorrect'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="saied.css">
</head>

<body class="container1">
    <form action="" method="post" autocomplete="off">
        <div class="container">
            <fieldset>
                <h2>Update Profile</h2>
                <p>Please fill in this form to update your account.</p>
                <hr>
                <div class="mid">
                    <label for="name"><b>Name</b></label><br>
                    <input type="text" placeholder="Enter Name" name="name" id="name" required
                        value="<?php echo htmlspecialchars($userData['name']); ?>"> <br><br>
                    <label for="email"><b>Email</b></label><br>
                    <input type="email" placeholder="Enter Email" name="email" id="email" required
                        value="<?php echo htmlspecialchars($userData['email']); ?>"><br><br>
                    <label for="old_password"><b>Old Password</b></label><br>
                    <input type="password" placeholder="Enter Old Password" name="old_password" id="old_password"
                        required><br><br>
                    <label for="new_password"><b>New Password</b></label><br>
                    <input type="password" placeholder="Enter New Password" name="new_password" id="new_password"
                        required><br><br>
                    <label for="confirm_password"><b>Confirm Password</b></label><br>
                    <input type="password" placeholder="Repeat New Password" name="confirm_password"
                        id="confirm_password" required><br><br>
                    <hr>
                </div>
                <div class="btn-div">
                    <button type="submit" name="submit"
                        style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 5px;">Update</button>

                    <br><br>
                </div>
            </fieldset>
        </div>
    </form>
</body>

</html>