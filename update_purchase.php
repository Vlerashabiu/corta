<?php
session_start();
include 'db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $purchase_id = intval($_POST['purchase_id']);
    $status = $_POST['status'];

    $allowed_statuses = ['pending', 'shipped', 'delivered', 'canceled'];
    if (!in_array($status, $allowed_statuses)) {
        die("Invalid status.");
    }

    $stmt = $conn->prepare("UPDATE purchases SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $purchase_id);
    
    if ($stmt->execute()) {
        header("Location: manage_purchases.php?success=Status updated");
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
