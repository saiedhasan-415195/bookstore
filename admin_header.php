<?php
include 'connect.php';
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/admin-header.css">    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
       

    </style>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="admin.php" class="logo">Admin Panel</a>
            <nav class="navbar">
                <a href="admin.php">Home</a>
                <a href="add_product.php">Add Products</a>
                <a href="admin_order.php">Orders</a>
                <a href="message.php">Messages</a>
            </nav>
            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>
            <div class="account-box" id="account-box">
                <p>User Name: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <a href="update_profile.php">Update Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </header>

    <script>
        document.getElementById('menu-btn').onclick = function() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        };

        document.getElementById('user-btn').onclick = function() {
            var accountBox = document.getElementById('account-box');
            accountBox.classList.toggle('active');
        };
    </script>
</body>
</html>
