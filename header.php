<?php
    include 'connect.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="./style.css">
    <!-- fontawesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="header.css">
</head>
<body>
  <header>
    <div class="header">
      <div class="class1">
        <h3>Book Store</h3>
      </div>
      <div class="class2">
        <form action="search.php" method="post">
          <input type="text" name="search" placeholder="Search book">
          <button class="bt" type="submit">Search</button>
        </form>
      </div>
      <div class="class3">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="user_orders.php">Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="about.php">About Us</a></li>
        </ul>
      </div>
      <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box" id="account-box">
        <p>User Name: <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
        <a href="user_update.php">Update Profile</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>

  <script>
    document.getElementById('menu-btn').onclick = function() {
        var navbar = document.querySelector('.class3 ul');
        navbar.classList.toggle('active');
    };

    document.getElementById('user-btn').onclick = function() {
        var accountBox = document.getElementById('account-box');
        accountBox.classList.toggle('active');
    };
  </script>
</body>
</html>
