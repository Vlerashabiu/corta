<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "corta";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Lidhja dështoi: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - CORTA</title>
    <link rel="stylesheet" href="store.css">
</head>
<body>

<header class="navbar">
    <div class="title">CORTA</div>
    <a href="home.html">Home</a>
    <a href="store.php">Store</a>
    <a href="contact.html">ContactUs</a>
    <a href="news.html">News</a>
    <button class="sign-up" onclick="window.location.href='signup.html'">Sign up</button>
    <button class="log-in" onclick="window.location.href='login.html'">Log in</button>
</header>

<h1>The Boutique</h1>

<div class="image">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<a href="product.php?id=' . $row['id'] . '">';
            echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '</a>';
            echo '<h4>' . $row['name'] . '</h4>';
            echo '<p>$' . number_format($row['price'], 2) . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>No products available.</p>";
    }
    ?>
</div>

<footer class="site-footer">
    <p>Copyright © 2024 - 2025 Corta, All Rights Reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>

