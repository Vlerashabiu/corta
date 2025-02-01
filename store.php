<?php
class Product {
    private $link;
    private $image;
    private $name;
    private $price;

   
    public function __construct($link, $image, $name, $price) {
        $this->setLink($link);
        $this->setImage($image);
        $this->setName($name);
        $this->setPrice($price);
    }

  
    public function setLink($link) {
        if (empty($link)) {
            throw new Exception("Linku nuk mund të jetë i zbrazët");
        }
        $this->link = $link;
    }

    public function setImage($image) {
        if (empty($image)) {
            throw new Exception("Imazhi nuk mund të jetë i zbrazët");
        }
        $this->image = $image;
    }

    public function setName($name) {
        if (empty($name)) {
            throw new Exception("Emri i produktit nuk mund të jetë i zbrazët");
        }
        $this->name = $name;
    }

    public function setPrice($price) {
        if (empty($price)) {
            throw new Exception("Çmimi nuk mund të jetë i zbrazët");
        }
        $this->price = $price;
    }

  
    public function getLink() {
        return $this->link;
    }

    public function getImage() {
        return $this->image;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }
}

$products = [
    new Product("image1.php", "foto1.png", "Chic Corduroy Bag", "$65.00"),
    new Product("image2.php", "foto2.png", "Urban Denim", "$68.00"),
    new Product("image3.php", "foto3.png", "Ocean Breeze Linen", "$76.00"),
    new Product("image4.php", "foto4.png", "Canvas Coast", "$60.00"),
    new Product("image5.php", "foto5.png", "Eco Cedar Bag", "$65.00"),
    new Product("image6.php", "foto6.png", "Kyoto Bamboo Bag", "$65.00"),
    new Product("image7.php", "foto7.png", "Denim Wanderer", "$48.00"),
    new Product("image8.php", "foto8.png", "Bamboo Temple", "$50.00"),
    new Product("image9.php", "foto9.png", "Seaside Linen Bag", "$70.00")
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
        <a href="home.php">Home</a>
        <a href="store.php">Store</a>
        <a href="contact.php">ContactUs</a>
        <a href="news.php">News</a>
        <button class="sign-up"><a href="signup.php">Sign up</a></button>
        <button class="log-in"><a href="login.php">Log in</a></button>
    </header>

<h1>The Boutique</h1>
<div class="image">
    <?php foreach (array_chunk($products, 3) as $row): ?>
        <div class="image-row">
            <?php foreach ($row as $product): ?>
                <div class="image-item">
                    <a href="<?= $product->getLink(); ?>">
                        <img src="<?= $product->getImage(); ?>" alt="<?= $product->getName(); ?>">
                    </a>
                    <h4><?= $product->getName(); ?></h4>
                    <p><?= $product->getPrice(); ?></p>
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
