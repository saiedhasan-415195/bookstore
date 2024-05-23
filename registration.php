<?php
include 'connect.php';

if(isset($_POST["submit"])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['confirmPassword']; 
    $user_type = $_POST['user_type']; 

    if($password === $password_repeat){
  
        $stmt = $conn->prepare("INSERT INTO users(name, username, email, password, user_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $password, $user_type);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            echo "<script> alert('Registration Successful'); </script>";
            header("Location: login.php");
        } else {
            echo "<script> alert('Registration Failed'); </script>"; 
        }

        $stmt->close();
    } else {
        echo "<script> alert('Password and confirm password do not match'); </script>"; 
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
<body class="container1">
    <form action="" method="post" autocomplete="off">
        
        <div class="container">
            <fieldset>
                <h2>Registration </h2>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <div class="mid">
                    <label for="name"><b>Name</b></label><br>
                    <input type="text" placeholder="Enter Name" name="name" id="name" required value=""> <br><br>           
                    <label for="username"><b>Username</b></label><br>
                    <input type="text" placeholder="Enter Username" name="username" id="username" required value=""><br><br> 
                    <label for="email"><b>Email</b></label><br>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required value=""><br><br> 
                    <label for="Password"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" id="Password" required value=""><br><br> 
                    <label for="confirmPassword"><b>Confirm Password</b></label><br>
                    <input type="password" placeholder="Repeat Password" name="confirmPassword" id="confirmPassword" required value=""><br><br>
                    <hr>
                </div>
                <div class="btn-div">
                <select name="user_type" id="user_type">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <button class="submit-button" type="submit" name="submit" >Register</button>
                    <br><br>
                    <p>Already have an account? <a href="login.php">Login</a>.</p>
                    <br><br>
                </div>
               
    
                

            </fieldset>
        </div>
    </form>

</body>
</html>
