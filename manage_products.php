<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $added_by = $_SESSION['username']; 

        if (!filter_var($image, FILTER_VALIDATE_URL)) {
            echo "Invalid image URL.";
        } else {
            $stmt = $conn->prepare("INSERT INTO products (name, price, image, added_by) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdss", $name, $price, $image, $added_by);
            
            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <h1>Manage Products</h1>

    <form method="POST">
        <h2>Add New Product</h2>
        <input type="hidden" name="action" value="add">
        
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
 
        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" required>

        <button type="submit">Add Product</button>
    </form>

    <footer>
        <p>Copyright © 2024 - 2025 Corta, All Rights Reserved.</p>
    </footer>

</body>
</html>
