<?php
session_start();
include 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "error" => "User not logged in"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    $stmt = $conn->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    if (!$price) {
        echo json_encode(["success" => false, "error" => "Product not found"]);
        exit;
    }

    $total_price = $price * $quantity;

    $stmt = $conn->prepare("INSERT INTO purchases (user_id, total_price) VALUES (?, ?)");
    $stmt->bind_param("id", $user_id, $total_price);
    if ($stmt->execute()) {
        $purchase_id = $stmt->insert_id;
        $stmt->close();

        $stmt = $conn->prepare("INSERT INTO purchase_items (purchase_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $purchase_id, $product_id, $quantity, $price);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to add purchase items"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "error" => "Failed to add purchase"]);
    }

    $conn->close();
}
?>
