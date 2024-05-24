<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="footer.css">
    <style>
        .footer {
            background-color: wheat;
            padding-left: 150px;
            margin: 30px;
        }

        .footer .grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        
        }

        .box {
            flex: 1;

        }

        .box h3 {
            color: purple;
            font-size: large;
            transition: border 0.3s ease;
        }

        .box h3:hover {
            text-transform: uppercase;
            border: 2px solid black;
        }

        .box a {
            color: black;
            display: block;
            margin: 10px;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .box a:hover {
            transform: translateX(10px);
        }
    </style>
</head>

<body>
    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>quick links</h3>
                <a href="index.php"> <i class="fas fa-angle-right"></i> home</a>
                <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
                <a href="contact.php"> <i class="fas fa-angle-right"></i> contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
                <a href="registration.php"> <i class="fas fa-angle-right"></i> register</a>
                <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
                <a href="user_orders.php"> <i class="fas fa-angle-right"></i> Orders</a>
            </div>

            <div class="box">
                <h3>contact us</h3>
                <a href="mob:01706617665"><i class="fas fa-phone"></i> 01706617665</a>
                <a href="mob:01852049697"><i class="fas fa-phone"></i> 01852049697</a>
                <a href="mailto:hasan15-3903@diu.edu.bd"><i class="fas fa-envelope"></i> hasan15-3903@diu.edu.bd</a>
                <a href="https://en.wikipedia.org/wiki/Dhaka#Government"> <i class="fas fa-map-marker-alt"></i>
                    Asulia,Dhaka,Bangladesh </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="https://www.facebook.com/saiedhasan3903?mibextid=ZbWKwL"><i
                        class="fab fa-facebook-f"></i>facebook</a>
                <a href="#"><i class="fab fa-twitter"></i>twitter</a>
                <a href="https://instagram.com/saeed_hasan415195?utm_source=qr&igshid=MWk3dmp4dzEzeWZrcw=="><i
                        class="fab fa-instagram"></i>instagram</a>
                <a
                    href="https://www.linkedin.com/in/saied-hasan-06880b218?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i
                        class="fab fa-linkedin"></i>linkedin</a>
            </div>

        </section>
    </footer>
</body>

</html>