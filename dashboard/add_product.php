<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $name, $price, $description);

    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding product.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add New Product</h1>
    <form method="POST" action="add_product.php">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>