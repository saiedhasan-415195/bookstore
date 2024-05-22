

<?php 
include 'connect.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
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
                <h2>Contact Us </h2>
                <p>Please fill in this form to Contact with us</p>
                <hr>
                <div class="mid">
                    <label for="name"><b>Name</b></label><br>
                    <input type="text" placeholder="Enter Name" name="name" id="name" required value=""> <br><br>          
                    <label for="email"><b>Email</b></label><br>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required value=""><br><br> 
                    <Label for="message"><b>Message</b></Label><br>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    <hr>
                </div>
                <div class="btn-div">
                    <button class="submit-button" type="submit" name="submit" >submit</button>
                    <br><br>
                </div>
               
    
                

            </fieldset>
        </div>
    </form>

</body>
</html>
