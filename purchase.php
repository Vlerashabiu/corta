<?php

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to purchase.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $product_name = $_POST['product_name'];
    $product_price = floatval($_POST['product_price']);
    $quantity = intval($_POST['quantity']);
    $total_price = $quantity * $product_price;

    $stmt = $conn->prepare("INSERT INTO purchases (user_id, total_price) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_price);
    $stmt->execute();
    $purchase_id = $stmt->insert_id;

    $stmt = $conn->prepare("INSERT INTO purchase_items (purchase_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isid", $purchase_id, $product_name, $quantity, $product_price);
    $stmt->execute();

    header("Location: store.php?success=1");
    exit();
}

?>