<?php
$products = [
    ["link" => "image1.html", "image" => "foto1.png", "name" => "Chic Corduroy Bag", "price" => "$65.00"],
    ["link" => "image2.html", "image" => "foto2.png", "name" => "Urban Denim", "price" => "$68.00"],
    ["link" => "image3.html", "image" => "foto3.png", "name" => "Ocean Breeze Linen", "price" => "$76.00"],
    ["link" => "image4.html", "image" => "foto4.png", "name" => "Canvas Coast", "price" => "$60.00"],
    ["link" => "image5.html", "image" => "foto5.png", "name" => "Eco Cedar Bag", "price" => "$65.00"],
    ["link" => "image6.html", "image" => "foto6.png", "name" => "Kyoto Bamboo Bag", "price" => "$65.00"],
    ["link" => "image7.html", "image" => "foto7.png", "name" => "Denim Wanderer", "price" => "$48.00"],
    ["link" => "image8.html", "image" => "foto8.png", "name" => "Bamboo Temple", "price" => "$50.00"],
    ["link" => "image9.html", "image" => "foto9.png", "name" => "Seaside Linen Bag", "price" => "$70.00"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to CORTA</title>
    <link rel="stylesheet" href="store.css">
    <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
</head>
<body>
<header class="navbar">
    <div class="title">CORTA</div>
    <a href="home.html">Home</a>
    <a href="store.html">Store</a>
    <a href="contact.html">ContactUs</a>
    <a href="news.html">News</a>
    <button class="sign-up"><a href="signup.html">Sign up</a></button> 
    <button class="log-in"><a href="login.html">Log in</a></button>
</header>
<h1>The Boutique</h1>
<div class="image">
    <?php foreach (array_chunk($products, 3) as $row): ?>
        <div class="image-row">
            <?php foreach ($row as $product): ?>
                <div class="image-item">
                    <a href="<?= $product['link']; ?>">
                        <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
                    </a>
                    <h4><?= $product['name']; ?></h4>
                    <p><?= $product['price']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
<footer class="site-footer">
    <div class="footer">
        <p>Copyright © 2024 - 2025 Corta, All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
