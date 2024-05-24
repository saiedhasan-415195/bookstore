<?php
include 'connect.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookStore</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="css/admin-header.css">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    .sb {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .sb form {
      display: flex;
      align-items: center;
    }

    .sb input[type="text"] {
      text-align: center;
      background-color: wheat;
      border: 1px solid #ccc;
      margin-left: 20px;
  
    }
    .sb .bt {
      margin-left: 3px;
      padding: 0 5px;
      border: none;
      background-color: #0e3864;
      color: #fff;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="flex">
      <a href="index.php" class="logo">BookStore</a>
      <div class="sb">
        <form action="search.php" method="post">
          <input type="text" name="search" placeholder="Search">
          <button class="bt" type="submit">Search</button>
        </form>
      </div>
      <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="user_orders.php">Orders</a>
        <a href="contact.php">Contact</a>
        <a href="about.php">About</a>
      </nav>
      <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div id="user-btn" class="fas fa-user"></div>
      </div>
      <div class="account-box" id="account-box">
        <p>User Name: <span><?php echo $_SESSION['user_name']; ?></span></p>
        <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
        <a  href="user_update.php">Update_Profile</a>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>

  <script>
    document.getElementById('menu-btn').onclick = function () {
      var navbar = document.querySelector('.navbar');
      navbar.classList.toggle('active');
    };

    document.getElementById('user-btn').onclick = function () {
      var accountBox = document.getElementById('account-box');
      accountBox.classList.toggle('active');
    };
  </script>
</body>
</html>

