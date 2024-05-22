<?php
    include 'connect.php';
    session_start();
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
    <!-- <link rel="stylesheet" href="css/admin-header.css">     -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }

        .class1 h3 {
            margin: 0;
        }

        .class2 form {
            display: flex;
        }

        .class2 input[type="text"] {
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px 0 0 5px;
        }

        .class2 button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }

        .class3 ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .class3 ul li {
            margin-left: 1rem;
        }

        .class3 ul li a {
            text-decoration: none;
            color: #333;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .class3 ul li a:hover {
            color: #007bff;
        }

        .icons {
            display: flex;
            align-items: center;
        }

        .icons .fas {
            font-size: 1.8rem;
            margin-left: 1rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .icons .fas:hover {
            color: #007bff;
        }

        .account-box {
            display: none;
            position: absolute;
            top: 60px; /* Adjust based on header height */
            right: 2rem;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            border-radius: 5px;
            width: 250px;
        }

        .account-box.active {
            display: block;
        }

        .account-box p {
            margin: 0.5rem 0;
            font-size: 1.4rem;
            color: #333;
        }

        .account-box span {
            font-weight: 700;
            color: #007bff;
        }

        .account-box a {
            display: block;
            margin: 0.5rem 0;
            font-size: 1.4rem;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .account-box a:hover {
            color: #0056b3;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .class3 ul {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
                display: none;
            }

            .class3 ul li {
                margin: 1rem 0;
                width: 100%;
                padding: 1rem 2rem;
                background-color: #f4f4f4;
                border-bottom: 1px solid #ddd;
            }

            .class3 ul.active {
                display: flex;
            }

            .icons .fas {
                margin-left: 0;
                margin-top: 1rem;
            }

            .icons #menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body>
  <header>
    <div class="header">
      <div class="class1">
        <h3>Book Store</h3>
      </div>
      <div class="class2">
        <form action="search.php" method="post">
          <input type="text" name="search" placeholder="Search">
          <button type="submit">Search</button>
        </form>
      </div>
      <div class="class3">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="user_orders.php">Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
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
