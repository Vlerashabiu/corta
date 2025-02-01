<?php
class Page {
    public $title;
    public $content;

    public function __construct($title, $content) {
        $this->title = $title;
        $this->content = $content;
    }

    public function renderTitle() {
        echo "<title>" . $this->title . "</title>";
    }

    public function renderContent() {
        echo "<div class='text'>" . $this->content . "</div>";
    }
}

$page = new Page("News - CORTA", "
    <h3>Special offer for new customers!</h3><br>
    <h5>Get an exclusive 15% discount on your first order!</h5>
    <h5> Register now and enjoy this special offer as a welcome to the CORTA family. </h5><br>
    <h5>Don't miss this fantastic opportunity to get started with style and savings!</h5>
");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $page->renderTitle(); ?>
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
            font-family: 'Major Mono Display', sans-serif;
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
            color: rgb(249, 244, 244);
            text-align: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
        }

        .text h3 {
            font-size: 25px;
            font-weight: bold;
            color: rgb(112, 95, 73);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .text h5 {
            font-size: 15px;
            line-height: 1.5;
            color: rgb(104, 85, 61);
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
    <header class="navbar">
        <div class="title">CORTA</div>
        <a href="home.php">Home</a>
        <a href="store.php">Store</a>
        <a href="contact.php">ContactUs</a>
        <a href="news.php">News</a>
        <button class="sign-up"><a href="signup.php">Sign up</a></button>
        <button class="log-in"><a href="login.php">Log in</a></button>
    </header>

    <?php $page->renderContent(); ?>

    <footer class="site-footer">
        <p>Copyright © 2024 - 2025 CORTA, All Rights Reserved.</p>
    </footer>
</body>

</html>


