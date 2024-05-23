<?php
include 'connect.php';
session_start();
if(isset($_POST["submit"])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' and password='$password'");
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin.php');

        }
        elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location: index.php');
        }
    }else{
        echo "<script>alert('Invalid email or password.');</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="saied.css">
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <div class="container">
            <fieldset>
                <h2>Login</h2>
                <p>Please fill in this form to login.</p>
                <hr>
                <div class="mid">
                    <label for="email"><b>Username or Email</b></label><br>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required value=""> <br><br>           
                    <label for="password"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required value=""><br><br> 
                </div>
                <hr>
                <div class="btn-div">
                     <button class="submit-button" type="submit" name="submit" >Login</button>
                    <!-- <p> <a href="forget.php">Forget Password</a></p> -->
                    <p>Don't have an account? <a href="registration.php">Registration</a>.</p>
                </div>
                <br><br>
            </fieldset>
        </div>
</body>
</html>
