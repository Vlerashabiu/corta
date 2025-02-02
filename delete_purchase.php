<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purchase_id = intval($_POST['id']);

    
    $stmt = $conn->prepare("DELETE FROM purchase_items WHERE purchase_id = ?");
    $stmt->bind_param("i", $purchase_id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM purchases WHERE id = ?");
    $stmt->bind_param("i", $purchase_id);
    
    if ($stmt->execute()) {
        header("Location: manage_purchases.php?success=Purchase deleted");
    } else {
        echo "Error deleting purchase: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
