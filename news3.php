<?php

class Navbar {
    public function render() {
        echo '
        <header class="navbar">
            <div class="title">CORTA</div>
            <a href="home.php">Home</a>
            <a href="store.php">Store</a>
            <a href="contact.php">Contact Us</a>
            <a href="news.php">News</a>
            <button class="sign-up"><a href="signup.php">Sign up</a></button>
            <button class="log-in"><a href="login.php">Log in</a></button>
        </header>';
    }
}

class Footer {
    public function render() {
        echo '<footer class="site-footer">
                <p>Copyright © 2024 - 2025 CORTA, All Rights Reserved.</p>
              </footer>';
    }
}

class Story {
    public function render() {
        echo '
        <div class="text">
            <h3>Our Story</h3>
            <br>
            <h5>Founded by three young girls with backgrounds in product design engineering and fashion design, 
            our brand is rooted in a shared passion for sustainability and style. Our journey began with a 
            deep-seated desire to create something meaningful. This shared experience fueled our determination to offer garments that reflect our values of simplicity, comfort, and authenticity.</h5><br>
            <h5>Finding the right fabrics proved to be a daunting task. We searched tirelessly for organic materials that met our 
            standards, sourced from distant corners of the world. Overcoming logistical challenges like transportation costs
            reinforced our commitment to quality and sustainability.</h5><br>
            <h5>Craftsmanship has always been at the heart of what we do. Each product is a testament to months of dedication and 
            attention to detail, ensuring that every piece not only meets but exceeds our high standards.</h5><br>
            <h5>Looking ahead, we are excited to share our journey and values with our community. Through genuine storytelling and engaging content,
            we aim to inspire a deeper appreciation for natural beauty and sustainable living.</h5>
        </div>';
    }
}

$navbar = new Navbar();
$footer = new Footer();
$story = new Story();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News - CORTA</title>
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: white;
            padding: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(219, 217, 219, 0.4);
            z-index: 10;
        }
        .title {
            font-size: 30px;
            font-family: 'Major Mono Display';
            letter-spacing: 8px;
            cursor: pointer;
            margin-top: 15px;
            color: black;
        }
        .navbar a {
            float: left;
            text-decoration: none;
            color: rgb(115, 132, 100);
            margin-right: 14px;
            margin-left: 10px;
            font-size: 17px;
        }
        a:hover {
            text-decoration: none;
        }
        .log-in {
            float: right;
            background-color: #e2d8c8;
            color: white;
            border: none;
            border-radius: 15px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 20px;
        }
        .log-in:hover {
            background-color: #c3b59e;
        }
        .sign-up {
            float: right;
            background-color: #e2d8c8;
            color: white;
            border-radius: 15px;
            border: none;
            padding: 5px 10px;
            margin-right: 20px;
            cursor: pointer;
        }
        .sign-up:hover {
            background-color: #c3b59e;
        }
        body {
            background-image: url('foto14.jpg');
            background-size: cover;
            background-position: center;
            color: rgb(3, 0, 0);
            text-align: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .text h3 {
            font-size: 25px;
            font-weight: bold;
            margin-top: 5%;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: rgb(112, 95, 73);
        }
        .text h5 {
            font-size: 15px;
            line-height: 1.5;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: rgb(104, 85, 61);
        }
        .site-footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            background-color: rgb(202, 216, 190);
            color: rgb(143, 155, 132);
            padding: 9px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <?php
    $navbar->render();
    $story->render();
    $footer->render();
    ?>

</body>

</html>
