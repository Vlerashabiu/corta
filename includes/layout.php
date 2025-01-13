<?php

function renderHeader($title = "Default Title") {
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$title</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
</head>
<body>
<header class="navbar">
    <div class="title">CORTA</div>
    <a href="home.php">Home</a>
    <a href="store.php">Store</a>
    <a href="contact.php">Contact Us</a>
    <a href="news.php">News</a>
    <button class="sign-up"><a href="signup.php">Sign up</a></button>
    <button class="log-in"><a href="login.php">Log in</a></button>
</header>
HTML;
}

function renderFooter() {
    echo <<<HTML
<footer class="site-footer">
    <div class="footer">
        <p>Copyright © 2024 - 2025 Corta, All Right Reserved.</p>
    </div>
</footer>
</body>
</html>
HTML;
}
?>

