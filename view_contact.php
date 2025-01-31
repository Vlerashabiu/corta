<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
</head>
<body>
    <h1>Contact Messages</h1>
    <?php
    $result = $conn->query("SELECT * FROM messages");
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p><strong>Name:</strong> {$row['name']}</p>";
        echo "<p><strong>Email:</strong> {$row['email']}</p>";
        echo "<p><strong>Message:</strong> {$row['message']}</p>";
        echo "<hr>";
        echo "</div>";
    }
    ?>
</body>
</html>
